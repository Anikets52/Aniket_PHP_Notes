<?php

use Database\Connection;

require "vendor/autoload.php";
try {
    $pdo = (new Connection())->getConnnection();
    // echo "Connection Successfull<BR>";
} catch (PDOException $e) {
    echo "Error:Connecting The Database:" . $e->getMessage();
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perpage = 5;
$offset = ($page - 1) * $perpage;

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
    $stmt->execute();
    $totalRows = (int)$stmt->fetchColumn();
    // echo $totalRows;
    $totalPages = (int)ceil($totalRows / $perpage);
    // echo $totalPages;
} catch (PDOException $e) {
    echo "Error:Fetching Total Records" . $e->getMessage();
}

try {

    $stmt = $pdo->prepare("SELECT* FROM users LIMIT {$perpage} OFFSET {$offset}");
    $stmt->execute();
    $users = $stmt->fetchAll();
    // echo "FETCH Successfull<BR>";
} catch (PDOException $e) {
    echo "Error:Fetching user deatils failed:" . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Crud</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="bg-gray-100 p-8 overflow-auto mt-4 h-screen ">
        <h2 class="text-3xl mb-4 w-full text-center font-bold">Student List</h2>
        <div class="div flex m-3 justify-end">
            <a href="add.php" class="bg-teal-500 text-white text-sm rounded-md md:text-sm px-4 py-2">Add a Student</a>
        </div>
        <!-- Classes Table -->
        <div class="relative overflow-auto">
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full bg-white border mb-10">
                    <thead>
                        <tr class="bg-[#2B4DC994] text-center text-xs md:text-sm font-thin text-white">
                            <th class="p-0">
                                <span class="block py-2 px-3 border-r border-gray-300">ID</span>
                            </th>
                            <th class="p-0">
                                <span class="block py-2 px-3 border-r border-gray-300">Student Name</span>
                            </th>
                            <th class="p-0">
                                <span class="block py-2 px-3 border-r border-gray-300">Email</span>
                            </th>
                            <th class="p-0">
                                <span class="block py-2 px-3 border-r border-gray-300">Maths</span>
                            </th>
                            <th class="p-0">
                                <span class="block py-2 px-3 border-r border-gray-300">English</span>
                            </th>
                            <th class="p-0">
                                <span class="block py-2 px-3 border-r border-gray-300">Science</span>
                            </th>
                            <th class="p-0">
                                <span class="block py-2 px-3 border-r border-gray-300">Total</span>
                            </th>
                            <th class="p-4 text-xs md:text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($users)) {
                            echo "
                            <tr class='border-b text-xs md:text-sm text-center text-gray-800'>
                            <td colspan='7' class='p-2 md:p-4  border-r border-blue-300 text-2xl font-bold'>No Data Found</td>
                            </tr>
                            ";
                        }
                        ?>
                        <?php foreach ($users as $user): ?>
                            <tr class="border-b text-xs md:text-sm text-center text-gray-800">
                                <td class="p-2 md:p-4  border-r border-blue-300"><?= $user['id'] ?></td>
                                <td class="p-2 md:p-4 border-r border-blue-300"><?= $user['name'] ?></td>
                                <td class="p-2 md:p-4 border-r border-blue-300"><?= $user['email'] ?></td>
                                <td class="p-2 md:p-4 border-r border-blue-300"><?= $user['math'] ?></td>
                                <td class="p-2 md:p-4 border-r border-blue-300"><?= $user['english'] ?></td>
                                <td class="p-2 md:p-4 border-r border-blue-300"><?= $user['science'] ?></td>
                                <td class="p-2 md:p-4 border-r border-blue-300"><b><?= $user['total'] ?></b></td>
                                <td class="relative p-2 md:p-4 flex justify-center space-x-2">
                                    <a href="update.php?id=<?= base64_encode($user['id']) ?>&page=<?= $page ?>" class="bg-blue-500 w-1/2 text-white px-3 py-1 rounded-md text-xs md:text-sm">Edit</a>
                                    <a href="#"
                                        data-id="<?= base64_encode($user['id']) ?>"
                                        class="delete bg-red-500 w-1/2 text-white px-3 py-1 rounded-md text-xs md:text-sm">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="relative p-2 md:p-4 flex justify-end space-x-2">
            <?php
            if ($page > 1) :
            ?>
                <a href="index.php?page=<?= $page - 1 ?>" class="bg-gray-500 w-24 text-center border-gray-600 border-2 text-white px-3 py-1 rounded-md text-xs md:text-sm">Previous</a>
            <?php endif; ?>
            <?php
            if ($page < $totalPages):
            ?>
                <a href="index.php?page=<?= $page + 1 ?>"
                    class=" bg-gray-500 border-gray-600 border-2 w-24 text-center text-white px-3 py-1 rounded-md text-xs md:text-sm">
                    Next
                </a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".delete").click(function(e) {
                e.preventDefault();
                var orgid = $(this).data("id")
                var id = atob($(this).data("id")); // get the data-id from the clicked element
                var flag = confirm(`Are you sure you want to delete user with ID :  ${id}?`);
                if (flag) {
                    window.location.href = `delete.php?id=${orgid}&page=<?= $page ?>`;
                }

            });
        });
    </script>
</body>

</html>