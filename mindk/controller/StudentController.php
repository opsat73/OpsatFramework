<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 29.08.2015
 * Time: 4:00
 */
namespace mindk\controller;

use mindk\modele\StudentRecord;
use mindk\view\Renderer;
use opsatFramework\utils\ServiceLocator;

class StudentController
{
    public function defaultAction() {
        $this->showAllStudents();
    }

    public function showAllStudents() {
        $studentRecords = new StudentRecord();
        $students = $studentRecords->getAllRecords();
        $serviceLocator = ServiceLocator::getInstance();
        $response = $serviceLocator->getService("response");
        $response->addContent("studentsTable", $students, "table");

        Renderer::renderPage();

    }

    public function addStudent() {
        $sl = ServiceLocator::getInstance();
        $rq = $sl->getService("request");
        $student = new StudentRecord();

        $values = $rq->getAllParameters();
        $keys = array_keys($rq->getAllParameters());

        foreach ($keys as $key) {
            if (($key != 'controller') && ($key != 'action')) {
                $field = 'field_'.$key;
                $student->$field = $values[$key];
            }
        }

        $student->save();
        $this->showAllStudents();
    }

    public function delete() {
        $sl = ServiceLocator::getInstance();
        $rq = $sl->getService("request");
        $id = $rq->getParameter("id");
        $student = new StudentRecord();
        $student = $student->getRecordsByKyeField($id);
        $student->delete();

        $this->showAllStudents();
    }

    public function edit() {
        $sl = ServiceLocator::getInstance();
        $rq = $sl->getService("request");
        $id = $rq->getParameter("id");
        $student = new StudentRecord();
        $student = $student->getRecordsByKyeField($id);
        $response = $sl->getService("response");
        $response->addContent("studentsForEdit", $student, "record");

        $this->showAllStudents();
    }

}