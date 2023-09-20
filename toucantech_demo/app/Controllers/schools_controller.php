<?php

require_once('../../Models/schools_model.php');

class SchoolsController {
    private $schoolsModel;

    public function __construct($conn) {
        $this->schoolsModel = new SchoolsModel($conn);
    }

    public function addSchool($school_name) {
        return $this->schoolsModel->addSchool($school_name);
    }

    public function listAllSchools() {
        return $this->schoolsModel->getSchools();
    }
}
?>
