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

}
?>
