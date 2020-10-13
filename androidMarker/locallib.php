<?php

namespace androidMarker;
require_once 'DatabaseHelper.php';

class locallib
{
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $dbname;


    public function __construct()
    {
        $this->dbhost = "127.0.0.1";
        $this->dbuser = "moodledude";
        $this->dbpass = "password";
        $this->dbname = "testDB";
    }

    public function get_androidmarker_submission($userid)
    {
        global $CFG;
        $d = new DatabaseHelper($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        return $d->get_record("feedback_marker", array('id' => $userid, 'assignment_id' => 20));
    }


    public function get_lecturer_zip_options()
    {
        $fileoptions = array('subdirs' => 1,
            "maxfiles" => 1,
            'accepted_types' => array(".zip"),
            'return_types' => 2);
        return $fileoptions;
    }

    public function get_required_documents_options()
    {
        $fileoptions = array("maxfiles" => 1,
            'accepted_types' => array(".txt"),
            'return_types' => 2);
        return $fileoptions;
    }
    public function get_androidmarker_feedback($userid) {
        global $CFG;
        $d = new DatabaseHelper($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        return $d->get_record("feedback_marker", array('id' => $userid, 'assignment_id' => 20));
    }

}


?>