<?php

use Database\Connection;

require "vendor/autoload.php";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $math = $_POST['math'];
        $english = $_POST['english'];
        $science = $_POST['science'];

        $total = (int)($math + $english + $science);
        $pdo = (new Connection())->getConnnection();
        $stmt = $pdo->prepare("INSERT INTO users(name,email,math,english,science,total) VALUES(?,?,?,?,?,?)");
        if ($stmt->execute([$name, $email, $math, $english, $science, $total])) {
            echo "
            <script>
            alert('New User Added Successfully!!');
            </script>
            ";

            try {
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
                $stmt->execute();
                $totalRows = (int)$stmt->fetchColumn();
                // echo $totalRows;
                $totalPages = (int)ceil($totalRows / 5);
                // echo $totalPages;
            } catch (PDOException $e) {
                echo "Error:Fetching Total Records" . $e->getMessage();
            }

            header("Refresh: 0.5; url=index.php?page={$totalPages}");
        } else {
            echo "
            <script>
            alert('Failed to Add New User!!');
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
    <title>Add User</title>
</head>

<body>
    <div class="bg-white s border-4 rounded-lg shadow relative m-10">

        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold">
                Add User
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

                        <input type="text" name="name" id="name" placeholder="Enter Name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                        <input type="email" name="email" id="email" placeholder="xyz@gmail.com" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                    </div>

                    <div class="col-span-6 flex gap-3">

                        <div class=" w-1/3 sm:col-span-">
                            <label for="math" class="text-sm font-medium text-gray-900 block mb-2">Math</label>
                            <input type="number" min="0" max="50" name="math" value="0" id="math" class=" change shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block  p-2.5" required="">
                        </div>

                        <div class="w-1/3 sm:col-span-">
                            <label for="science" class="text-sm font-medium text-gray-900 block mb-2">Science</label>
                            <input type="number" min="0" max="50" value="0" name="science" id="science" class="change shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block  p-2.5" required="">
                        </div>

                        <div class="w-1/3 sm:col-span-">
                            <label for="english" class="text-sm font-medium text-gray-900 block mb-2">English</label>
                            <input type="number" min="0" max="50" value="0" name="english" id="english" class="change shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block  p-2.5" required="">
                        </div>
                    </div>
                    <div class="col-span-6 ">
                        <label for="total" class="text-sm font-medium text-gray-900 block mb-2">Total</label>
                        <input type="number" name="total" id="total" readonly value="0" disabled id="total" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                    </div>
                </div>


        </div>

        <div class="p-6 border-t border-gray-200 rounded-b w-full flex justify-center gap-2">
            <a href="index.php" class="text-white w-1/6  bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back</a>

            <input type="submit" value="Add" name="submit" class="text-white w-1/6  bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" />
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
                $('#total').val(parseInt(science + math + english));
            });
        });
    </script>
</body>

</html>