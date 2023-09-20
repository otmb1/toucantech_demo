<?php

class SchoolsModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addSchool($school_name) {
        $school_name = $this->conn->real_escape_string($school_name);
        
        $sql = "INSERT INTO schools (school_name) VALUES ('$school_name')";
        
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getSchools() {
        $sql = "SELECT * FROM schools";
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
}
?>
