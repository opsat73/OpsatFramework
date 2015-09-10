<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 06.08.2015
 * Time: 1:17
 */

namespace opsatFramework\core\modele\activeRecord;

/**
 * @property \PDO $DBconnect
 */
abstract class ActiveRecord
{

    private static $DBMconnect;

    private $validators = array();

    function __construct()
    {
        $dns = "mysql:host=localhost;dbname=mindk;";
        if (self::$DBMconnect == null) {
            self::$DBMconnect = new \PDO($dns, "root", "RE3r9D+z");
        }
    }

    protected abstract function getTableName();

    public abstract function getKeyFieldName();

    public function save() {
        $needToSave = $this->getFieldValues();
        $columnQueue = "";
        $valueQueue ="";

        foreach ($needToSave as $key => $value) {
            $columnQueue = $columnQueue.$key.", ";
            $valueQueue = $valueQueue.'"'.$value.'", ';
        }
        $columnQueue = substr($columnQueue, 0, strlen($columnQueue)-2);
        $valueQueue = substr($valueQueue, 0, strlen($valueQueue)-2);
        $query = "replace into ".$this -> getTableName(). "( ".$columnQueue.") values ( ".$valueQueue.")";
        self::$DBMconnect->beginTransaction();
        self::$DBMconnect->query($query);
        self::$DBMconnect->commit();
    }

    private function getFieldNames() {
        $reflect = new \ReflectionClass($this);
        $fields = $reflect->getProperties();
        $fieldsName = array();
        for ($i = 0; $i < count($fields); $i++) {
            if (preg_match('|field_(.*)|', $fields[$i]->getName(), $res))
                $fieldsName[$i] = $res[1];
        }
        return $fieldsName;
    }

    private function getFieldValues() {
        $reflect = new \ReflectionClass($this);
        $fields = $reflect ->getProperties();
        $values = array();

        for ($i = 0; $i < count($fields); $i++) {
            if (preg_match('|field_(.*)|', $fields[$i]->getName(), $res))
                $values[$res[1]] = $fields[$i]->getValue($this);
        }
        return $values;
    }

    public function getAllRecords() {
        return $this->getrecordsByField(null, null, null);
    }

    /**
     * @todo implement getRecordByKeyField
     */

    public function getRecordsByField($fieldName, $keyValue, $needFirstOnly) {
        $condition = null;
        if ($fieldName === null) {
            $condition = "where " . $this->getKeyFieldName() . " = ? limit 1";
        } else {
            $condition = "where " . $fieldName . " = ?";
            if ($needFirstOnly)
                $condition = $condition." limit 1";
        }

        if ($keyValue === null)
            $condition = null;
        $selectQuery = "select * from ".$this->getTableName()." ". $condition;
        $statement = self::$DBMconnect->prepare($selectQuery);
        $result = $statement->execute(array($keyValue));
        $records = array();
        $recordsCount = 0;
        $className = \get_class($this);
        while ($row = $statement->fetch()) {
            $object = new $className;
            foreach ($this->getFieldNames() as $key) {
                $object->{"field_".$key} = $row[$key];
            }
            $records[$recordsCount++] = $object;
        }
        return $records;
    }

    public function getRecordsByKyeField($value)
    {
        $result = $this->getRecordsByField(null, $value, null);
        return $result[0];
    }

    public function delete() {
        $statement = self::$DBMconnect->prepare("delete from ".$this->getTableName()." where ".$this->getKeyFieldName(). " = ?");
        $key = $this->getFieldValues();
        $key = $key[$this->getKeyFieldName()];
        if ($key != null) {
            $statement->execute(array($key));
        }
    }

    public function registreValidator($validatorKey, $validator) {
        $this->validators[$validatorKey] = $validator;
    }

    public function unregisterValidator($validatorKey) {
        unset($this->validators[$validatorKey]);
    }

    public function validate() {
        foreach($this->validators as $validator) {
            $validator->validate();
        }
    }
}