<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_COOKIE['cart']) && empty($_SESSION['cart'])) {
    $_SESSION['cart'] = json_decode(base64_decode($_COOKIE['cart']));
}
echo base64_decode($_COOKIE['cart']) . "<br>";
print_r($_SESSION['cart']);

// Sample products
$products = [
    ['id' => 1, 'name' => 'Laptop', 'price' => 20000],
    ['id' => 2, 'name' => 'Smartphone', 'price' => 10000],
    ['id' => 3, 'name' => 'Headphones', 'price' => 5000],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $product_id = (int)$_POST['product_id'];
                $quantity = (int)$_POST['quantity'];

                if ($quantity > 0) {
                    if (isset($_SESSION['cart'][$product_id])) {
                        $_SESSION['cart'][$product_id] += $quantity;
                    } else {
                        $_SESSION['cart'][$product_id] = $quantity;
                    }

                    // Update cookie
                    $cookie_data = base64_encode(json_encode($_SESSION['cart']));
                    setcookie('cart', $cookie_data, time() + (1 * 24 * 3600)); // 1 day
                }
                break;

            case 'remove':
                $product_id = (int)$_POST['product_id'];
                if (isset($_SESSION['cart'][$product_id])) {
                    unset($_SESSION['cart'][$product_id]);
                    $cookie_data = base64_encode(json_encode($_SESSION['cart']));
                    setcookie('cart', $cookie_data, time() + (1 * 24 * 3600));
                }
                break;

            case 'clear':
                $_SESSION['cart'] = [];
                setcookie('cart', '', time() - 3600); // Delete cookie
                break;
        }
    }
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            $total += $product['price'] * $quantity;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .product {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
        }

        .cart {
            border: 1px solid #333;
            padding: 10px;
            margin-top: 20px;
        }

        .cart-item {
            margin: 5px 0;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Shopping Cart</h1>

    <h2>Products</h2>
    <?php foreach ($products as $product): ?>
        <div class="product">
            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <p>Price: ₹<?php echo number_format($product['price'], 2); ?></p>
            <form method="post">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>

    <h2>Your Cart</h2>
    <div class="cart">
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty</p>
        <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $product_id => $quantity): ?>
                <?php foreach ($products as $product): ?>
                    <?php if ($product['id'] == $product_id): ?>
                        <div class="cart-item">
                            <?php echo htmlspecialchars($product['name']); ?>
                            (x<?php echo $quantity; ?>)
                            - ₹<?php echo number_format($product['price'] * $quantity, 2); ?>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <p><strong>Total: ₹<?php echo number_format($total, 2); ?></strong></p>
            <form method="post">
                <input type="hidden" name="action" value="clear">
                <button type="submit">Clear Cart</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>