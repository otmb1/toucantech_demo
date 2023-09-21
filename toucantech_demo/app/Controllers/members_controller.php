<?php

require_once('../../Models/members_model.php');
require_once('../../Models/schools_model.php');

class MembersController {
    private $membersModel;

    public function __construct($conn) {
        $this->membersModel = new MembersModel($conn);
    }

    public function addMember($name, $email) {
        return $this->membersModel->addMember($name, $email);
    }

    public function listMembersBySchool($school_id) {
        if ($school_id === -1) {
			return $this->membersModel->getAllMembers();
		} else {
			return $this->membersModel->getMembersBySchool($school_id);
		}
    }
	
	public function getSchoolsByMemberId($member_id) {
        return $this->membersModel->getSchoolsByMemberId($member_id);
    }
	
	public function associateMemberWithSchool($member_id, $school_id) {
        return $this->membersModel->associateMemberWithSchool($member_id, $school_id);
	}	
	
	public function getLastInsertedMemberId() {
        return $this->membersModel->getLastInsertedMemberId();
    }
	
	public function updateMember($member_id, $name, $email) {
		error_log("Received update request with ID: $member_id, Name: $name, Email: $email");
		return $this->membersModel->updateMember($member_id, $name, $email);		
		error_log("Updating member with ID: $member_id, Name: $name, Email: $email");
	}
	
	public function deleteMember($member_id) {
		error_log("Received delete request with ID: $member_id");
		return $this->membersModel->deleteMember($member_id);
		error_log("Deleting member with ID: $member_id");
	}

}
?>
