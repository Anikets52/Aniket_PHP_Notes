<?php

use Database\Connection;

require "vendor/autoload.php";

if (!isset($_GET['id']) && !isset($_GET['page'])) {
    header("Refresh:0.5,url=index.php");
}

$id = base64_decode($_REQUEST['id']);
$page = $_GET['page'];
$pdo = (new Connection())->getConnnection();
$stmt = $pdo->prepare("SELECT * FROM users WHERE id= :id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();

// print_r($row);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $math = $_POST['math'];
        $english = $_POST['english'];
        $science = $_POST['science'];
        $id = $_REQUEST['id'];
        $total = (int)($math + $english + $science);
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?,math=?,english=?,science=?,total=? WHERE id= ?");
        if ($stmt->execute([$name, $email, $math, $english, $science, $total, $id])) {
            echo "
            <script>
            alert('Details updated!!');
            </script>
            ";
            header("Refresh: 0.5; url=index.php?page={$page}");
        } else {
            echo "
            <script>
            alert('Failed!!');
            </script>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Edit Details</title>
</head>

<body>
    <div class="bg-white s border-4 rounded-lg shadow relative m-10">

        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold">
                Edit Details
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="product-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-6">
            <form action="<?php $_PHP_SELF ?>" method="post">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Name</label>
                        <input type="hidden" name="id" id="id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="<?= $id ?>">
                        <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="" value="<?= $row['name'] ?>">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                        <input type="email" name="email" value="<?= $row['email'] ?>" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                    </div>

                    <div class="col-span-6 flex gap-3">

                        <div class=" w-1/3 sm:col-span-">
                            <label for="math" class="text-sm font-medium text-gray-900 block mb-2">Math</label>
                            <input type="number" min="0" max="50" name="math" value="<?= $row['math'] ?>" id="math" class=" change shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block  p-2.5" required="">
                        </div>

                        <div class="w-1/3 sm:col-span-">
                            <label for="science" class="text-sm font-medium text-gray-900 block mb-2">Science</label>
                            <input type="number" min="0" max="50" name="science" id="science" value="<?= $row['science'] ?>" class="change shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block  p-2.5" required="">
                        </div>

                        <div class="w-1/3 sm:col-span-">
                            <label for="english" class="text-sm font-medium text-gray-900 block mb-2">English</label>
                            <input type="number" min="0" max="50" name="english" id="english" value="<?= $row['english'] ?>" class="change shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block  p-2.5" required="">
                        </div>
                    </div>
                    <div class="col-span-6 ">
                        <label for="total" class="text-sm font-medium text-gray-900 block mb-2">Total</label>
                        <input type="number" name="total" id="total" value="<?= $row['total'] ?>" readonly value="0" disabled id="total" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                    </div>
                </div>


        </div>

        <div class="p-6 border-t border-gray-200 rounded-b w-full flex justify-center gap-3">
            <a href="index.php?page=<?= $page ?>" class="text-white w-1/6  bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back</a>
            <input type="submit" value="Edit" name="submit" class="text-white w-1/6  bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" />
        </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $(".change").change(function() {
                // alert('h');
                var math = parseInt($('#math').val());
                var science = parseInt($('#science').val());
                var english = parseInt($('#english').val());
                $('#total').val(science + math + english);
            });
        });
    </script>
</body>

</html>