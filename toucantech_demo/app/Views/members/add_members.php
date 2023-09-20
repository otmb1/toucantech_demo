<?php
include('../../../public/navbar.php');
require_once('../../../app/Controllers/members_controller.php');
require_once('../../../app/Controllers/schools_controller.php');
require_once('../../../config/database.php');
$membersController = new MembersController($conn);
$schoolsController = new SchoolsController($conn);
$schools = $schoolsController->listAllSchools();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_name = $_POST['member_name'];
    $member_email = $_POST['member_email'];
    $selectedSchools = $_POST['school_id'];

    $result = $membersController->addMember($member_name, $member_email);

    if ($result) {
        $member_id = $membersController->getLastInsertedMemberId();
        foreach ($selectedSchools as $school_id) {
            $membersController->associateMemberWithSchool($member_id, $school_id);
        }
        echo '<div class="alert alert-success" role="alert">Successfully added a member!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error adding member. Please try again.</div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Member</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Add Member</h1>
        <form action="add_members.php" method="post">
            <div class="mb-3">
                <label for="member_name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="member_name" required>
            </div>
            <div class="mb-3">
                <label for="member_email" class="form-label">Email Address:</label>
                <input type="email" class="form-control" name="member_email" required>
            </div>
            <div class="mb-3">
                <label for="schools" class="form-label">Select School(s):</label>
                <select name="school_id[]" class="form-select" multiple required>
                    <?php foreach ($schools as $school): ?>
                        <option value="<?php echo $school['school_id']; ?>"><?php echo $school['school_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary">Add Member</button>
			</div>
        </form>
		<div class="text-center">
			<a href="list_members.php" class="btn btn-secondary mt-3">View All Members</a>
		</div>
    </div>
</body>
</html>
