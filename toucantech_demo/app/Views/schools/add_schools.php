<?php
require_once('../../../app/Controllers/schools_controller.php');
require_once('../../../config/database.php');
$schoolsController = new SchoolsController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_name = $_POST['school_name'];

    $result = $schoolsController->addSchool($school_name);

    if ($result) {
        echo "Successfully added a school!";
    } else {
        echo "Error adding school. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add School</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h1>Add School</h1>
    <form action="add_schools.php" method="post">
        <label for="school_name">School Name:</label>
        <input type="text" name="school_name" required>
        <button type="submit">Add School</button>
    </form>
    <a href="list_schools.php">View All Schools</a>
</body>
</html>
