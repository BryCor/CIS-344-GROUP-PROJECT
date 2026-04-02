<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO pets (name, species, breed, age, Gender) VALUES ('$name', '$species', '$breed', '$age', '$gender')";
    mysqli_query($conn, $sql);
    header("Location: pets.php");
}

$sql = "SELECT * FROM pets";
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
        Gender: <select name="gender" required>
            <option>Male</option>
            <option>Female</option>
        </select><br>
        <input type="submit" value="Add Pet">
    </form>

    <h2>Pet List</h2>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['pet_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['species']; ?></td>
            <td><?php echo $row['breed']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['Gender']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
