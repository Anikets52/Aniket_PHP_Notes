<?php
session_start();

// Generate CSRF token
if (!isset($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    // echo $_SESSION["csrf_token"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Form Validation</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="flex items-center justify-center p-12">
        <!-- Author: FormBold Team -->
        <div class="mx-aut o w-full max-w-[550px] bg-white">
            <form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-5 flex text-center justify-center items-center  min-w-full">
                    <h1 for="name" class="mb-3 text-center text-3xl font-bold tracking-wider text-[#07074D]">
                        Form
                    </h1>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">

                </div>
                <div class="mb-5">
                    <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                        Full Name
                    </label>
                    <input type="text" name="name" id="name" placeholder="Full Name" required
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="phone" class="mb-3 block text-base font-medium text-[#07074D]">
                                Phone Number
                            </label>
                            <input type="number" name="phone" id="phone" placeholder="Enter your phone number" required
                                class="contact w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>


                </div>


                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 ">
                        <div class="mb-5">
                            <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                Date Of Birth
                            </label>
                            <input type="date" name="DOB" id="date" required max="<?= date('Y-m-d') ?>"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>

                </div>

                <div class="mb-5">
                    <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                        Upload Profile Photo
                    </label>
                    <input type="file" name="file" id="file" required accept="image/png, image/gif, image/jpeg"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <div class="mb-5 pt-3">
                    <label class="mb-5 block text-base font-semibold text-[#07074D] sm:text-xl">
                        Address Details
                    </label>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 ">
                            <div class="mb-5">
                                <textarea name="address" id="address" cols="3" rows="3" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                            </textarea>
                            </div>
                        </div>
                    </div>


                </div>

                <div>
                    <input type="submit" value="Submit" name="submit"
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none" />

                </div>
            </form>
        </div>
    </div>
    <script>
        // Contact Number Validation
        $(".contact").change(function() {
            var contact = $(this).val();

            // Check if the input has exactly 10 digits and is a number
            if (!/^\d{10}$/.test(contact)) {
                alert("Invalid Contact Number. Please enter a 10-digit number.");
                $(this).val(""); // Clear the invalid input
            }
        });
    </script>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        // die("CSRF token validation failed.");
        exit;
    }

    if (isset($_POST['submit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "aniket";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            echo "error" . $conn->error;
            die("Connection failed.");
        } else {
            // echo "<br>connection done!!";
        }

        // print_r($_SERVER);
        $name = $_POST['name'];
        $name = htmlspecialchars(trim($name), ENT_QUOTES, "UTF-8");
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // echo "Valid email: $email";
        } else {
            die("Invalid email.");
        }
        $Phone = $_POST['phone'];
        if (filter_var($Phone, FILTER_VALIDATE_INT)) {
            // echo "Valid Phone Number: $Phone";
        } else {
            die("Invalid Phone Number.");
        }
        $DOB = $_POST['DOB'];
        $address = $_POST['address'];
        // print_r($_FILES['file']);
        $message = "";

        if (isset($_FILES['file'])) {
            // File information

            $file_tmp_path = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            $file_error = $_FILES['file']['error'];

            // Validate file
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];


            //MIME Checks
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
            finfo_close($finfo);
            if (!in_array($mime,  $allowed_types)) {
                // echo "Invalid file type.<br>";
                die("Invalid file type.");
                exit;
            }

            $max_size = 10 * 1024 * 1024; // 10MB

            $fileExt = explode('.', $file_name);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size <= $max_size) {
                        $file_name_new = uniqid('', true) . "." . $fileActualExt;
                        $file_destination = 'uploads/' . $file_name_new;
                        if (move_uploaded_file($file_tmp_path, $file_destination)) {
                            $message = $message . "file uploaded successfully ";
                        } else {
                            $message = $message . "file not uploaded ";
                        }
                    } else {
                        $message = $message . "File size too large (max 10MB) ";
                    }
                } else {
                    $message = $message . "there was an error uploading your image ";
                }
            } else {
                $message = $message . "Invalid file type ";
            }
        }


        $sql = "INSERT INTO `user` (`name`,`email`, `Contact`, `dob`, `Address`, `ProfilePicture`) VALUES (?, ?, ?, ?, ?, ?);";
        $smt = $conn->prepare($sql);
        $smt->bind_param(
            "ssisss",
            $name,
            $email,
            $Phone,
            $DOB,
            $address,
            $file_destination
        );
        if ($smt->execute()) {
            echo "record Inserted " . $message;
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        } else {
            echo "record Insertion Failed !! " . $message;
        }
    }
}



?>