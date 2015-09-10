<?php
    $sl = \opsatFramework\utils\ServiceLocator::getInstance();
    $responce = $sl->getService("response");
    $studentsForEdit = $responce->getContent("studentsForEdit");
    $action = "addStudent";
    $buttonName = "ADD";
    $formTitle = "Add new student";
    if ($studentsForEdit != null) {
        $buttonName = "SAVE";
        $formTitle = "Edit student";
        echo "<script>\n
        $(\"document\").ready(function(){\n
            $('#modal').modal();\n
        });\n
        </script>";
    }

    $gender = 'Male';
    if ($studentsForEdit != null)
        if ($studentsForEdit->field_gender == 'F')
            $gender = 'Female';
?>
<script>
    $(document).ready(function() {
        $('#studentInput').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                        notEmpty : {
                            message: 'First name can not be empty'
                        }
                    }
               } ,
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'Last name can not be empty'
                        }
                    }
                },
                grp: {
                    validators: {
                        notEmpty: {
                            message: 'Group name can not be empty'
                        }
                    }
                },
                birthday: {
                    validators: {
                        notEmpty: {
                            message: 'Birthday can not be empty'
                        }
                    }
                }
            }
        });
    });
</script>

<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn btn-danger pull-right" data-dismiss="modal">X</div>
                <H1><%=$formTitle;%></H1>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="index.php" method="post" id="studentInput">
                    <input name="id" class="hidden" value="<%=$studentsForEdit->field_id; %>">

                    <div class="form-group">
                        <label for="first_name" class="control-label">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<%=$studentsForEdit->field_first_name; %>">
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="control-label">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<%=$studentsForEdit->field_last_name; %>">
                    </div>

                    <label for="gender" class="control-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" value="<%=$gender; %>">
                        <option>Male</option>
                        <option>Female</option>
                    </select>

                    <div class="form-group">
                        <label for="group" class="control-label" >Group</label>
                        <input type="text" class="form-control" id="group" name="grp" value="<%=$studentsForEdit->field_grp; %>">
                    </div>

                    <div class="form-group">
                        <label for="birthday" class="control-label">Birthday</label>
                        <input type="text" class="form-control" id="birthday" name="birthday" value="<%=$studentsForEdit->field_birthday; %>">
                    </div>

                    <input name="controller" value="students" class="hidden">
                    <input name="action" value="<%=$action; %>" class="hidden">
                    <script type="text/javascript">
                        $in =  $('#birthday');
                        $in.datepicker({format: 'yyyy-mm-dd'});
                    </script>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" id="add" class="btn btn-success pull-right"><%=$buttonName;%></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>