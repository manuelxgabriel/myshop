<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Client</h2>
        <a class="btn btn-success" href="/myshop/create_pdo.php" role="button"> Add Client</a>
        <table class="table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $pdo = "";
                    include "database_connection.php";

                    // Reads all the rows from the database table
                    $sql = "SELECT * FROM clients";
                    $result = $pdo->query($sql);

                    // Check the sql query
                    if(!$result){
                        die("Invalid query: ". $pdo->errorInfo());
                    }

                    // Read data of each row
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        echo "
                            <tr>
                                <td>$row[id]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[phone]</td>
                                <td>$row[address]</td>
                                <td>$row[created_at]</td>
                                <td>
                                    <a class='btn btn-warning btn-sm' href='/myshop/edit.php?id=$row[id]'>Edit </a>
                                    <a class='btn btn-danger btn-sm' href='/myshop/delete.php?id=$row[id]'>Delete</a>
                                </td>
                            </tr>
                        ";
//                      Edit button: links to the edit page with the item's ID passed as URL parameter
                    }



                ?>



            </tbody>
        </table>
    </div>

</body>
</html>