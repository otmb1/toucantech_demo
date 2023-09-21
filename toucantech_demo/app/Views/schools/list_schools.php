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
    <link rel="stylesheet" type="text/css" href="../../../public/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include('../../../public/navbar.php'); ?>
    <div class="container mt-4">
		<h1 class="mb-4 text-center">List of Schools</h1>
		<table class="table table-hover mt-3">
			<thead class="table-primary">
				<tr>
					<th>ID</th>
					<th>School Name</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($schools as $school): ?>
					<tr>
						<td><?php echo $school['school_id']; ?></td>
						<td><?php echo $school['school_name']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="container mt-2 text-center">
			<a href="add_schools.php" class="btn btn-primary mt-3">Add New School</a>
		</div>
	</div>
</body>
</html>
