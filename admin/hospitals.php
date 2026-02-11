<?php
session_start();
require_once __DIR__ . '/../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}

$result = $conn->query("SELECT * FROM hospitals");
?>

<h2>Hospitals</h2>

<form method="post">
    <input type="text" name="name" placeholder="Hospital Name" required>
    <button name="add">Add</button>
</form>

<?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $conn->query("INSERT INTO hospitals(name) VALUES('$name')");
    header("Location: hospitals.php");
}
?>

<ul>
<?php while ($row = $result->fetch_assoc()) { ?>
    <li><?= $row['name']; ?></li>
<?php } ?>
</ul>
