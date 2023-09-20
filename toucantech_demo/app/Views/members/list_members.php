<?php
require_once('../../../app/Controllers/members_controller.php');
require_once('../../../app/Controllers/schools_controller.php');
require_once('../../../config/database.php');
$membersController = new MembersController($conn);
$schoolsController = new SchoolsController($conn);

if (isset($_POST['filter_school'])) {
    $selectedSchoolId = $_POST['filter_school'];
    if ($selectedSchoolId == 0) {
        $school_id = -1;
    } else {
        $school_id = $selectedSchoolId;
    }
    $members = $membersController->listMembersBySchool($school_id);
} else {
    $school_id = -1;
	$members = $membersController->listMembersBySchool($school_id);
}

$schools = $schoolsController->listAllSchools();
?>
<!DOCTYPE html>
<html>
<head>
    <title>List Members</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include('../../../public/navbar.php'); ?>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">List of Members</h1>
        <form action="list_members.php" method="post">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <label for="filter_school" class="form-label">Filter by School:</label>
                    <select name="filter_school" class="form-select">
                        <option value="0">All Schools</option>
                        <?php foreach ($schools as $school): ?>
                            <option value="<?php echo $school['school_id']; ?>"><?php echo $school['school_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
					<button type="submit" class="btn btn-primary mt-2">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-hover mt-5">
            <thead class="table-primary">
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>School(s)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo $member['member_name']; ?></td>
                        <td><?php echo $member['member_email']; ?></td>
                        <td>
                            <?php
                            $member_id = $member['member_id'];
                            $memberSchools = $membersController->getSchoolsByMemberId($member_id);
                            foreach ($memberSchools as $school) {
                                echo $school['school_name'] . "<br>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
		
    </div>
</body>
</html>
