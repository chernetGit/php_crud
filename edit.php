<?php
$servername = 'localhost';
$username = 'root';
$password = "";
$database = 'myshop';
// create connection
$connection = new mysqli($servername, $username, $password, $database);


$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET method: show the data of the client
    if (!isset($_GET["id"])) {
        header("location: /myshop_php_app/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
    header("location: /myshop_php_app/index.php");
    exit;
     }

        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
} 
else{
    //POST method : show the data of the client

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }
    
    $sql = "UPDATE clients SET name='$name',email='$email',phone='$phone',address='$address' WHERE id = $id";

    $result = $connection->query($sql);

    if (!$result) {
        $errorMessage = "Invalid query: ".$connection->error;
        break;
    }
        $errorMessage = "Client updated successfully";
        header("location: /myshop_php_app/index.php");
        exit;

    }while(false);
    //while true lihonm yichilal
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <h2>New Client</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Name
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Email
                </label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Phone
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Address
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <?php 
           if (!empty($successMessage)) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>$successMessage</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
            ?>


            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                 <button class="btn btn-primary">
                    Submit
                </button>
                </div>
                <div class="col-sm-3 d-grid">     
                    <a  class="btn btn-outline-primary" href="/myshop_php_app/index.php" role="button">
                        Cancel
                    </a>             
                </div>
            </div>
        </form>
    </div>
</body>
</html>