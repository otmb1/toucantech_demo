<?php
include('../../../public/navbar.php');
require_once('../../../app/Controllers/schools_controller.php');
require_once('../../../config/database.php');
$schoolsController = new SchoolsController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_name = $_POST['school_name'];

    $result = $schoolsController->addSchool($school_name);

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Successfully added a school!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error adding school. Please try again.</div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add School</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Add School</h1>
        <form action="add_schools.php" method="post">
            <div class="mb-3">
                <label for="school_name" class="form-label">School Name:</label>
                <input type="text" class="form-control" name="school_name" required>
            </div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary">Add School</button>
			</div>
        </form>
		<div class="text-center">
			<a href="list_schools.php" class="btn btn-secondary mt-3">View All Schools</a>
		</div>
    </div>
</body>
</html>
