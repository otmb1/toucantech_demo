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
    <link rel="stylesheet" type="text/css" href="../../../public/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
					<th>Actions</th>
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
						<td>
							<button class="btn btn-primary update-member" data-member-id="<?php echo $member_id; ?>" data-toggle="modal" data-target="#updateMemberModal">Update</button>
							<button class="btn btn-danger delete-member" data-member-id="<?php echo $member_id; ?>" data-toggle="modal" data-target="#deleteMemberModal">Delete</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<div class="modal fade" id="updateMemberModal" tabindex="-1" role="dialog" aria-labelledby="updateMemberModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="updateMemberModalLabel">Update Member</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="update-member-form">
							<input type="hidden" id="update-member-id" name="member_id">

							<div class="form-group">
								<label for="update-member-name">Name:</label>
								<input type="text" class="form-control" id="update-member-name" name="member_name">
							</div>

							<div class="form-group">
								<label for="update-member-email">Email Address:</label>
								<input type="email" class="form-control" id="update-member-email" name="member_email">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="update-member-button">Update</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="deleteMemberModal" tabindex="-1" role="dialog" aria-labelledby="deleteMemberModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="deleteMemberModalLabel">Confirm Deletion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this member?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-danger" id="confirm-delete">Delete</button>
					</div>
				</div>
			</div>
		</div>
    </div>
	<script>
		$(document).ready(function () {
			 $('.update-member').click(function () {
				var memberId = $(this).data('member-id');

				var memberName = $(this).closest('tr').find('td:eq(0)').text();
				var memberEmail = $(this).closest('tr').find('td:eq(1)').text();

				$('#update-member-id').val(memberId);
				$('#update-member-name').val(memberName);
				$('#update-member-email').val(memberEmail);
				$('#updateMemberModal').modal('show');
			});

			$('#update-member-button').click(function () {
				var formData = $('#update-member-form').serialize();
				
				console.log("Updating member with data:", formData);

				$.post('../../../app/Controllers/members_controller.php', { action: 'update-member', data: formData }, function (response) {
					console.log('Response:', response);
					if (response.success) {
						var memberId = $('#update-member-id').val();
						var newName = $('#update-member-name').val();
						var newEmail = $('#update-member-email').val();
						$('tr[data-member-id="' + memberId + '"] td:eq(0)').text(newName);
						$('tr[data-member-id="' + memberId + '"] td:eq(1)').text(newEmail);

						alert('Member updated successfully');
					} else {
						alert('Failed to update member. Please try again.');
					}

					$('#updateMemberModal').modal('hide');
				});
			});

			$('.delete-member').click(function () {
				var memberId = $(this).data('member-id');

				$('#deleteMemberModal').modal('show');

				$('#confirm-delete').click(function () {
					console.log("Deleting member with ID:", memberId);
					
					$.post('../../../app/Controllers/members_controller.php', { action: 'delete-member', id: memberId }, function (response) {
						console.log('Response:', response);
						if (response.success) {
							$('tr[data-member-id="' + memberId + '"]').remove();

							alert('Member deleted successfully');
						} else {
							alert('Failed to delete member. Please try again.');
						}

						$('#deleteMemberModal').modal('hide');
					});
				});
			});
		});
	</script>
</body>
</html>