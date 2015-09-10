<table class="table table-hover">
    <thead>
    <tr>
        <td>EDIT</td>
        <th>first name</th>
        <th>last name</th>
        <th>gender</th>
        <th>birthday</th>
        <th>group</th>
        <td>DELETE</td>
    </tr>
    </thead>
    <tbody>
    <?php
        $serviceLocator = opsatFramework\utils\ServiceLocator::getInstance();
        $response = $serviceLocator->getService("response");
        $students = $response->getContent("studentsTable");
        if ($students != null)
            foreach($students as $student)
               printRow($student);
    ?>
    </tbody>
</table>

<?php
 function printRow($student) {
     echo "<tr>";
     echo '<td><a href="index.php?controller=students&action=edit&id='.$student->field_id.'" class="btn btn-default btn-block"><i class="glyphicon glyphicon-edit"></i></a></td>';
     echo "<th>".$student->field_first_name."</th>";
     echo "<th>".$student->field_last_name."</th>";
     $gender = 'Male';
     if ($student->field_gender == 'F')
         $gender = 'Female';
     echo "<th>".$gender."</th>";
     echo "<th>".$student->field_birthday."</th>";
     echo "<th>".$student->field_grp."</th>";
     echo '<td><a href="index.php?controller=students&action=delete&id='.$student->field_id.'" class="btn btn-default btn-block"><i class="glyphicon glyphicon-trash"></i></a></td>';
     echo "</tr>";
 }

?>