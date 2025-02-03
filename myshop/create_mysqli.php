<?php

$type = 'mysql';
$servername = "localhost";
$database = "myshop";
$port = "3306";
$charset = "utf8mb4";
$username = "root";
$password = "root";

// Create connection
try {
    $connection = new mysqli($servername, $username, $password, $database, $port);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}


$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data sent via POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Start a loop to perform validation and break if any issue is found
    do {
        // Check if any of the required fields are empty
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            // Set an error message if any field is empty
            $errorMessage = "All the fields are required";
            break; // Exit the loop
        }

        try {

            $sql = "INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $phone, $address);
            $stmt->execute();

            $name = "";
            $email = "";
            $phone = "";
            $address = "";

            $successMessage = "Customer added successfully";
            header("location: /myshop/index.php");
            exit;


        } catch (mysqli_sql_exception $e) {
            // Catch the specific MySQLi error
            $errorMessage = $e->getMessage();
        }

    } while (false);

}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>My Shop</title>
</head>
<body>
<div class="container my-5">
    <h2>New Client</h2>

    <?php
    if (!empty($errorMessage)) {

        echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
                    </div>
                    ";
    }
    ?>

    <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo
            " <div class='row mb-3'>
                            <div class='offset-sm-3 col-sm-6'>
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Successfully added</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
                                </div>
                            </div>
                      </div> ";
        }
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
            </div>
        </div>


    </form>

</div>

</body>
</html>