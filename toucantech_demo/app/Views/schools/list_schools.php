<?php
require_once('../../../app/Controllers/schools_controller.php');
require_once('../../../config/database.php');
$schoolsController = new SchoolsController($conn);
$schools = $schoolsController->listAllSchools();
?>
<!DOCTYPE html>
<html>
<head>
    <title>List Schools</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h1>List of Schools</h1>
    <ul>
        <?php foreach ($schools as $school): ?>
			<li><?php echo $school['school_id']; ?>, <?php echo $school['school_name']; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="add_schools.php">Add New School</a>
</body>
</html>
