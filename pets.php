<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $intake_date = $_POST['intake_date'];

    $sql = "INSERT INTO pets (name, species, breed, age, sex, intake_date) VALUES ('$name', '$species', '$breed', '$age', '$sex', '$intake_date')";
    mysqli_query($conn, $sql);
    header("Location: pets.php");
}

$status = isset($_GET['status']) ? $_GET['status'] : 'All';
$sql = "SELECT * FROM pets";
if ($status != 'All') {
    $sql .= " WHERE status = '$status'";
}
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Pets</h1>
    <a href="index.php">Home</a> | <a href="adopters.php">Adopters</a> | <a href="applications.php">Applications</a>

    <h2>Add Pet</h2>
    <form method="post">
        Name: <input type="text" name="name" required><br>
        Species: <input type="text" name="species" required><br>
        Breed: <input type="text" name="breed"><br>
        Age: <input type="number" name="age" required><br>
        Sex: <select name="sex" required>
            <option>Male</option>
            <option>Female</option>
        </select><br>
        Intake Date: <input type="date" name="intake_date" required><br>
        <input type="submit" value="Add Pet">
    </form>

    <h2>Pet List</h2>
    <a href="pets.php?status=All">All</a> |
    <a href="pets.php?status=Available">Available</a> |
    <a href="pets.php?status=Adopted">Adopted</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Intake</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['pet_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['species']; ?></td>
            <td><?php echo $row['breed']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['sex']; ?></td>
            <td><?php echo $row['intake_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
