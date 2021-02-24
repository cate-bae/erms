<div class="card">
    <?php if (in_array(get_user_type(), [-1, 0])) { ?>

    <div class="header">
        <h2>
            <?=$page_title?>
        </h2>
    </div>   
    <?php } ?>
    <div class="body">
        <div class="form-horizontal">
            
            <div class="table-responsive">
                <table class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">
                                Special Skills and Hobbies
                                <button type="button" class="btn btn-primary waves-effect" onclick="$('#addSkill').modal('show')">
                                    <i class="material-icons">add</i>
                                    <span>Add</span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($info['skills'] as $skill) { ?>

                        <tr>
                            <td><?=$skill->skill?></td>
                            <td style="min-width: 110px;">
                                <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                    onclick='editForm("Skill", <?=json_encode($skill)?>)'
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Edit">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                    onclick="deleteData('skill', '<?=$skill->id?>')"
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Delete">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            
            
            <div class="table-responsive">
                <table class="table table-form table-condensed table-hover table-bordered children">
                    <thead>
                        <tr>
                            <th colspan="2">
                                Non-academic Distinctions/Recognition
                                <button type="button" class="btn btn-primary waves-effect" onclick="$('#addRecognition').modal('show')">
                                    <i class="material-icons">add</i>
                                    <span>Add</span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($info['recognitions'] as $recognition) { ?>

                        <tr>
                            <td><?=$recognition->name?></td>
                            <td style="min-width: 110px;">
                                <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                    onclick='editForm("Recognition", <?=json_encode($recognition)?>)'
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Edit">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                    onclick="deleteData('recognition', '<?=$recognition->id?>')"
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Delete">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            
            <div class="table-responsive">
                <table class="table table-form table-condensed table-hover table-bordered children">
                    <thead>
                        <tr>
                            <th colspan="2">
                                Membership in Association/Organization
                                <button type="button" class="btn btn-primary waves-effect" onclick="$('#addMembership').modal('show')">
                                    <i class="material-icons">add</i>
                                    <span>Add</span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($info['memberships'] as $membership) { ?>

                        <tr>
                            <td><?=$membership->name?></td>
                            <td style="min-width: 110px;">
                                <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                    onclick='editForm("Membership", <?=json_encode($membership)?>)'
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Edit">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                    onclick="deleteData('membership', '<?=$membership->id?>')"
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Delete">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade in" data-backdrop="static" id="addSkill">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title">ADD SPECIAL SKILLS AND HOBBIES</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_skill/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="skill" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#addSkill').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="editSkill">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT SPECIAL SKILLS AND HOBBIES</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/skill/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="skill" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editSkill').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="addRecognition">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">ADD NON-ACADEMIC DISTINCTIONS/RECOGNITION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_recognition/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#addRecognition').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="editRecognition">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT NON-ACADEMIC DISTINCTIONS/RECOGNITION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/recognition/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editRecognition').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="addMembership">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">ADD MEMBERSHIP IN ASSOCIATION/ORGANIZATION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_membership/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#addMembership).modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="editMembership">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT MEMBERSHIP IN ASSOCIATION/ORGANIZATION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/membership/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editMembership').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
.table th, .table td {
    vertical-align: middle !important;
}
.card .header h2 {
    position: relative;
    min-height: 18px;
    text-transform: uppercase;
}
.card .header h2 button {
    right: 0;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
</style>