<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 21.08.2015
 * Time: 23:14
 */

namespace test\framework;

require_once "__DIR__\\..\\..\\..\\opsatFramework\\core\\modele\\activeRecord\\ActiveRecord.php";
require_once "__DIR__\\..\\..\\..\\mindk\\modele\\StudentRecord.php";

use mindk\test as fortest;

class ActiveRecordTest extends \PHPUnit_Framework_TestCase
{
    public function testTruncateTable() {
        $dns = "mysql:host=localhost;dbname=mindk;";
        $connection = new \PDO($dns, "root", "RE3r9D+z");
        $connection->query("truncate table students");
    }

    public function testAddRecord() {

        $record = new fortest\TestAbstractActiveRecordFactory();

        $record->field_birthday = "1993-08-04";
        $record->field_first_name = "Vitalii";
        $record->field_last_name = "Korovai";
        $record->field_gender = "M";
        $record->field_grp = "itz-11c";
        $record->save();

        $record2 = $record->getAllRecords();
        $record2 = $record2[0];
        $this->AssertEquals($record2->field_gender, "M", "gender is wrong");
        $this->AssertEquals($record2->field_first_name, "Vitalii", "first name is wrong");
        $this->AssertEquals($record2->field_last_name, "Korovai", "last name is wrong");
        $this->AssertEquals($record2->field_grp, "itz-11c", "group name is wrong");
        $this->AssertEquals($record2->field_birthday, "1993-08-04", "birthday is wrong");

        $record2->field_first_name = "Serhii";
        $record2->field_id = null;
        $record2->save();

        $record3 = $record2->getAllRecords();
        $this->AssertEquals(count($record3), 2, "wrong records count");
        $this->AssertNotEquals($record3[0]->field_id, $record3[1]->field_id, "wrong first id");
    }

    /**
     * @todo modele select only by Key
     */

    public function testSelectByKey() {
        $allRecords = new fortest\TestAbstractActiveRecordFactory();
        $allRecords = $allRecords->getAllRecords();
        $key = $allRecords[0]->field_id;

        $record = new fortest\TestAbstractActiveRecordFactory();
        $record = $record->getRecordsByKyeField($key);
        $this->AssertEquals($record->field_id, $allRecords[0]->field_id, "key fields not equals");
    }

    /**
     * @todo modele select by field
     */

    public function testSelectByField() {
        $allRecords = new fortest\TestAbstractActiveRecordFactory();
        $allRecords = $allRecords->getAllRecords();
        $key = $allRecords[0]->field_first_name;

        $record = new fortest\TestAbstractActiveRecordFactory();
        $record = $record->getRecordsByField("first_name", $key, false);
        $record = $record[0];
        $this->AssertEquals($record->field_first_name, $key, "field");
    }

    /**
     * @todo modele select firs by field
     */
    public function testSelectByFieldFirst() {
        $allRecords = new fortest\TestAbstractActiveRecordFactory();
        $allRecords = $allRecords->getAllRecords();
        $key = $allRecords[0]->field_gender;

        $record = new fortest\TestAbstractActiveRecordFactory();
        $record = $record->getRecordsByField("gender", $key, true);
        $this->AssertEquals(count($record), 1, "field");
    }

    /**
     * @todo modele delete
     */

    public function testDeleteRecords() {
        $allRecords = new fortest\TestAbstractActiveRecordFactory();
        $allRecords = $allRecords->getAllRecords();
        foreach ($allRecords as $record) {
            $record->delete();
        }

        $allRecords = new fortest\TestAbstractActiveRecordFactory();
        $allRecords = $allRecords->getAllRecords();
        $this->AssertEquals(count($allRecords), 0, "result is not empty");
    }
}
