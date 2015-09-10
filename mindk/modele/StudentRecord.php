<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 06.08.2015
 * Time: 1:54
 */

namespace mindk\modele;

use opsatFramework\core\modele\activeRecord\ActiveRecord;

class StudentRecord extends ActiveRecord
{
    public $field_id = null;
    public $field_first_name = null;
    public $field_last_name = null;
    public $field_gender = null;
    public $field_grp = null;
    public $field_birthday = null;

    protected function getTableName()
    {
        return "students";
    }

    public function getKeyFieldName()
    {
       return "id";
    }
}