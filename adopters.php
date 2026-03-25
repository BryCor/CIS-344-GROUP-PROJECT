<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO adopters (full_name, email, phone, address) VALUES ('$full_name', '$email', '$phone', '$address')";
    mysqli_query($conn, $sql);
    header("Location: adopters.php");
}

$result = mysqli_query($conn, "SELECT * FROM adopters");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adopters</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Adopters</h1>
    <a href="index.php">Home</a> | <a href="pets.php">Pets</a> | <a href="applications.php">Applications</a>

    <h2>Add Adopter</h2>
    <form method="post">
        Full Name: <input type="text" name="full_name" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="text" name="phone" required><br>
        Address: <input type="text" name="address"><br>
        <input type="submit" value="Add Adopter">
    </form>

    <h2>Adopter List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['adopter_id']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['address']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
