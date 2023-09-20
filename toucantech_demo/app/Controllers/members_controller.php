<?php

require_once('../../Models/members_model.php');
require_once('../../Models/schools_model.php');

class MembersController {
    private $membersModel;

    public function __construct($conn) {
        $this->membersModel = new MembersModel($conn);
    }

    public function addMember($name, $email, $school_id) {
        return $this->membersModel->addMember($name, $email, $school_id);
    }

    public function listMembersBySchool($school_id) {
        if ($school_id === -1) {
			return $this->membersModel->getAllMembers();
		} else {
			return $this->membersModel->getMembersBySchool($school_id);
		}
    }
	
	public function associateMemberWithSchool($member_id, $school_id) {
        return $this->membersModel->associateMemberWithSchool($member_id, $school_id);
	}	

}
?>
