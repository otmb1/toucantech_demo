<?php

class MembersModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addMember($name, $email, $school_id) {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        
        $sql = "INSERT INTO members (member_name, member_email, school_id) VALUES ('$name', '$email', '$school_id')";
        
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
	
	public function getAllMembers() {
		$sql = "SELECT * FROM members";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			$members = [];
			while ($row = $result->fetch_assoc()) {
				$members[] = $row;
			}
			return $members;
		} else {
			return [];
		}
	}


    public function getMembersBySchool($school_id) {
        $school_id = $this->conn->real_escape_string($school_id);
        
        $sql = "SELECT * FROM members WHERE school_id = '$school_id'";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            $members = [];
            while ($row = $result->fetch_assoc()) {
                $members[] = $row;
            }
            return $members;
        } else {
            return [];
        }
    }
	
	public function associateMemberWithSchool($member_id, $school_id) {
        $member_id = $this->conn->real_escape_string($member_id);
        $school_id = $this->conn->real_escape_string($school_id);

        $sql = "INSERT INTO member_school (member_id, school_id) VALUES ('$member_id', '$school_id')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>
