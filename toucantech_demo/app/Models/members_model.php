<?php

class MembersModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addMember($name, $email) {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        
        $sql = "INSERT INTO members (member_name, member_email) VALUES ('$name', '$email')";
        
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
        $sql = "SELECT * FROM members m INNER JOIN member_school ms ON m.member_id = ms.member_id WHERE ms.school_id = '$school_id'";
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
	
	public function getSchoolsByMemberId($member_id) {
		$member_id = $this->conn->real_escape_string($member_id);
		$sql = "SELECT s.school_name FROM schools s INNER JOIN member_school ms ON s.school_id = ms.school_id WHERE ms.member_id = '$member_id'";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			$schools = [];
			while ($row = $result->fetch_assoc()) {
				$schools[] = $row;
			}
			return $schools;
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
	
	public function getLastInsertedMemberId() {
		$sql = "SELECT LAST_INSERT_ID() AS member_id";
		$result = $this->conn->query($sql);

		if ($result) {
			$row = $result->fetch_assoc();
			return $row['member_id'];
		} else {
			return null;
		}
	}
	
}
?>
