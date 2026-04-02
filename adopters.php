<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO adopters (Name, Email) VALUES ('$name', '$email')";
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
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        <input type="submit" value="Add Adopter">
    </form>

    <h2>Adopter List</h2>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['adopter_id']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Email']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
