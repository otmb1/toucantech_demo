<?php
require_once('../../../app/Controllers/members_controller.php');
require_once('../../../app/Controllers/schools_controller.php');
require_once('../../../config/database.php');
$membersController = new MembersController($conn);
$schoolsController = new SchoolsController($conn);

if (isset($_POST['filter_school'])) {
    $selectedSchoolId = $_POST['filter_school'];
    $members = $membersController->listMembersBySchool($selectedSchoolId);
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
</head>
<body>
    <h1>List of Members</h1>
    <form action="list_members.php" method="post">
        <label for="filter_school">Filter by School:</label>
        <select name="filter_school">
            <option value="">All Schools</option>
            <?php foreach ($schools as $school): ?>
                <option value="<?php echo $school['school_id']; ?>"><?php echo $school['school_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>School</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?php echo $member['member_name']; ?></td>
                    <td><?php echo $member['member_email']; ?></td>
                    <td><?php echo $school['school_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="add_members.php">Add New Member</a>
</body>
</html>
