<?php
include "database_connection.php";


$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == "GET" ){
    // GET method: show the data of th client

    if(!isset($_GET["id"])){
        header('Location: /myshop/index.php');
        exit;
    }

    $id = $_GET["id"];

    echo "<script>console.log('Id: ".$id."')</script> ";

    // Read the row of the selected client from database table
    $sql = "SELECT * FROM clients WHERE id =$id";
    $result = $pdo->query($sql);
    $row = $result->fetch();

    if(!$row){
        header("location: /myshop/index.php ");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];

//    while($row = $result->fetch()){
//
//        $name = $row["name"];
//        $email = $row["email"];
//        $phone = $row["phone"];
//        $address = $row["address"];
//        echo $name . $email . $phone . $address . "<br>";
//        echo "<script>console.log('Id: ".$name."')</script> ";
//    }


} else {
    // POST method: Update the data of the client
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        // Check if all the fields are filled
        if(empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage = "All fields are required";
        }

        $sql = "UPDATE clients SET name = '$name', email = '{$email}', phone = '{$phone}' WHERE id = {$id}";

//        $sql = "UPDATE clients"
//            ."SET name = '{$name}', email = '{$email}', phone = '{$phone}', address = '{$address}' "
//            ."WHERE id = {$id}";

        $result = $pdo->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $pdo->errorInfo();
            break;
        }

        $successMessage = "Client updated successfully";

        header("location: /myshop/index.php");
        exit;


    } while(false);

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
    if(!empty($errorMessage)){

        echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
                    </div>
                    ";
    }
    ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address*</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address?>">
            </div>
        </div>

        <?php
        if(!empty($successMessage)){
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