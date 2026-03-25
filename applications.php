<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $app_id = $_POST['application_id'];
        if ($_POST['action'] == 'approve') {
            mysqli_query($conn, "UPDATE applications SET status='Approved' WHERE application_id=$app_id");
            $pet_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pet_id FROM applications WHERE application_id=$app_id"))['pet_id'];
            mysqli_query($conn, "UPDATE pets SET status='Adopted' WHERE pet_id=$pet_id");
        } elseif ($_POST['action'] == 'deny') {
            mysqli_query($conn, "UPDATE applications SET status='Denied' WHERE application_id=$app_id");
        }
        header("Location: applications.php");
    } else {
        $adopter_id = $_POST['adopter_id'];
        $pet_id = $_POST['pet_id'];
        $notes = $_POST['notes'];
        $sql = "INSERT INTO applications (adopter_id, pet_id, notes) VALUES ($adopter_id, $pet_id, '$notes')";
        mysqli_query($conn, $sql);
        header("Location: applications.php");
    }
}

$adopters = mysqli_query($conn, "SELECT adopter_id, full_name FROM adopters");
$pets = mysqli_query($conn, "SELECT pet_id, name FROM pets WHERE status='Available'");
$apps = mysqli_query($conn, "SELECT a.application_id, b.full_name, p.name, p.species, a.application_date, a.status, a.notes FROM applications a JOIN adopters b ON a.adopter_id=b.adopter_id JOIN pets p ON a.pet_id=p.pet_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Applications</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Applications</h1>
    <a href="index.php">Home</a> | <a href="pets.php">Pets</a> | <a href="adopters.php">Adopters</a>

    <h2>Submit Application</h2>
    <form method="post">
        Adopter: <select name="adopter_id" required>
            <?php while ($row = mysqli_fetch_assoc($adopters)) { ?>
                <option value="<?php echo $row['adopter_id']; ?>"><?php echo $row['full_name']; ?></option>
            <?php } ?>
        </select><br>
        Pet: <select name="pet_id" required>
            <?php while ($row = mysqli_fetch_assoc($pets)) { ?>
                <option value="<?php echo $row['pet_id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br>
        Notes: <input type="text" name="notes"><br>
        <input type="submit" value="Submit">
    </form>

    <h2>Applications List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Adopter</th>
            <th>Pet</th>
            <th>Species</th>
            <th>Date</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($apps)) { ?>
        <tr>
            <td><?php echo $row['application_id']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['species']; ?></td>
            <td><?php echo $row['application_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['notes']; ?></td>
            <td>
                <?php if ($row['status'] == 'Pending') { ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="application_id" value="<?php echo $row['application_id']; ?>">
                        <input type="submit" name="action" value="approve">
                        <input type="submit" name="action" value="deny">
                    </form>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
