<?php

namespace androidMarker\Test;

use androidMarker\locallib;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;

class locallibTest extends TestCase
{
    use TestCaseTrait;

    // Instantiate pdo once for test clean-up / fixture loda
    static private $pdo = null;

    // Instantiate once per test
    private $conn = null;

    public function setUp(): void
    {
        global $CFG;
        $this->dbhost = $CFG->dbhost;
        $this->dbuser = $CFG->dbuser;
        $this->dbpass = $CFG->dbpass;
        $this->dbname = $CFG->dbname;
        $this->tableName = "feedback_marker";
        $this->fixtures = __DIR__ . DIRECTORY_SEPARATOR . "fixtures" . DIRECTORY_SEPARATOR . "ams_emulators_fixture.xml";
        $this->databaseValue =    array("0" => array("id" => 1, "assignment_id" => 20, "user_id" => 2, "submission_id" => 58, "priority" => -1, "status" => "Pending",));
    }


    final public function getConnection()
    {
        // TODO: Implement getConnection() method.
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }
        return $this->conn;
    }

    protected function getDataSet()
    {
        // TODO: Implement getDataSet() method.
        return $this->createFlatXMLDataSet($this->fixtures);
    }

    public function testGetLecturerZipOptions()
    {
        $locallib = new locallib();
        $this->assertIsArray($locallib->get_lecturer_zip_options());
        $this->assertIsArray($locallib->get_required_documents_options());
    }

    public function testAndroidSubmission()
    {

        $locallib = new locallib();
        $array = $locallib->get_androidmarker_submission(1);
        $array2 = $locallib->get_androidmarker_feedback(1);
        $this->assertEquals($this->databaseValue[0]['id'],$array[0]['id']);
        $this->assertEquals($this->databaseValue[0]['id'],$array2[0]['id']);
    }
}