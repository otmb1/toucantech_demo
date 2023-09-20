<?php
require_once('../../../app/Controllers/members_controller.php');
require_once('../../../app/Controllers/schools_controller.php');
require_once('../../../config/database.php');
$membersController = new MembersController($conn);
$schoolsController = new SchoolsController($conn);
$schools = $schoolsController->listAllSchools();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_name = $_POST['member_name'];
    $member_email = $_POST['member_email'];
    $school_id = $_POST['school_id'];

    $result = $membersController->addMember($member_name, $member_email, $school_id);

    if ($result) {
        echo "Successfully added a member!";
    } else {
        echo "Error adding member. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Member</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h1>Add Member</h1>
    <form action="add_members.php" method="post">
        <label for="member_name">Name:</label>
        <input type="text" name="member_name" required>
        <label for="member_email">Email Address:</label>
        <input type="email" name="member_email" required>
        <label for="schools">Select School(s):</label>
        <select name="school_id" multiple required>
            <?php foreach ($schools as $school): ?>
                <option value="<?php echo $school['school_id']; ?>"><?php echo $school['school_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Add Member</button>
    </form>
    <a href="list_members.php">View All Members</a>
</body>
</html>
