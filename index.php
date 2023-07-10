<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    
    <div container my-5>
        <h2>List of clients</h2>
        <a class=" btn btn-primary" href="/myshop_php_app/create.php" role="button">New Client</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Acton</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = 'localhost';
                $username = 'root';
                $password = "";
                $database = 'myshop';
                // create connection
                $connection = new mysqli($servername, $username, $password, $database);
                if ($connection ->connect_error) {
                    die("Connection failed".$connection->connect_error);
                }

                // Read all row from DB table
                $sql = "SELECT * FROM clients";
                $result = mysqli_query($connection, $sql);
                if (!$result) {
                    # code...
                    die("Invalid query: " . $connection->error);
                }

                while ($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $created_at = $row['created_at'];
                    echo "
                    <tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$phone</td>
                    <td>$address</td>
                    <td>$created_at</td>
                    <td>
                    <button class='btn btn-primary'>
                    <a href='/myshop_php_app/edit.php?id=".$id."' class='text-light'>
                    Edit
                    </a>
                    </button>
                   <button class='btn btn-primary'
                    <a href='/myshop_php_app/delete.php?id=".$id."' class='text-light'>
                    Delete
                    </a>
                    </button>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>