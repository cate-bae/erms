<!-- employment status: active, resigned, retired
status: contractual, JO, permanent/regular
    regular 
        - benefits
        - can have leave
            - 1.5/month
                - vacation: 5days before
start date
designation: department and position
profile: completion status
Account -->

<div class="card">
    <div class="header">
        <h2>GENERAL INFORMATION 
            <span class="label label-<?=get_emp_status_class(issetor($info->emp_status, 0))?>"><?=get_all_employment_status()[issetor($info->emp_status, 0)]?></span>
        </h2>
    </div>
    <div class="body">

        <button type="button" class="btn btn-sm btn-info waves-effect" onclick="changeProfilePicture()">
            <i class="material-icons">image</i>
            <span>Change Profile Picture</span>
        </button>
    
        <?php //if (in_array(get_user_type(), [-1, 0])) { ?>
        
        <a href="<?=base_url()?>employee/Export_pds/index/<?=$user_id?>" class="btn btn-primary waves-effect">
            <i class="material-icons">print</i>
            <span>Export Personal Data</span>
        </a>
        <?php //} ?>

        <h2 class="card-inside-title">
            NAME
            <button type="button" class="btn btn-sm btn-warning waves-effect" onclick="$('#editName').modal('show')">
                <i class="material-icons">edit</i>
                <span>Edit</span>
            </button>
        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 20%">Surname</th>
                    <td colspan="3"><?=issetor($info->last_name)?></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>                        
                        <?=issetor($info->first_name)?>
                    </td>
                    <th style="width: 20%">Name Extension</th>
                    <td>
                        <?=issetor($info->ext_name)?>
                    </td>
                </tr>
                <tr>
                    <th>Middle Name</th>
                    <td colspan="3">
                        <?=issetor($info->middle_name)?>
                    </td>
                </tr>         
            </tbody>
        </table>

        <h2 class="card-inside-title">
            DESIGNATION
            <?php if (in_array(get_user_type(), [-1, 0])) { ?>

            <button type="button" class="btn btn-sm btn-warning waves-effect" onclick="$('#editDesignation').modal('show')">
                <i class="material-icons">edit</i>
                <span>Edit</span>
            </button>
            <?php } ?>

        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 25%;">Department</th>
                    <td style="width: 75%;">
                        <?=issetor($info->department_name)?>
                    </td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>
                        <?=issetor($info->position_name)?> 
                    </td>
                </tr>
                <tr>
                    <th>Date Employed</th>
                    <td>
                        <div class="form-line demo-masked-input">
                            <?=empty($info->date_employed) ? '' : date('m/d/Y', strtotime($info->date_employed))?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>
                        <?=get_all_job_status()[issetor($info->job_status, 0)]?> 
                        <?php if (issetor($info->job_status, 0) == 1) echo '('.issetor($info->regular_date, 0).')'?>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?=get_all_employment_status()[issetor($info->emp_status, 0)]?> 
                    </td>
                </tr>
            </tbody>
        </table>

        <?php if (in_array(get_user_type(), [-1]) || get_user_data()['id'] == $user_id) { ?>

        <h2 class="card-inside-title">
            ACCOUNT
            <button type="button" class="btn btn-sm btn-warning waves-effect" onclick="$('#editAccount').modal('show')">
                <i class="material-icons">edit</i>
                <span>Edit</span>
            </button>

            <?php if (get_user_data()['id'] != $user_id && issetor($info->disabled) == 1) { ?>

            <button type="button" class="btn btn-sm btn-success waves-effect" onclick="disableAccount(0)">
                <i class="material-icons">check</i>
                <span>Enable</span>
            </button>
            <?php } ?>

            <?php if (get_user_data()['id'] != $user_id && issetor($info->disabled) == 0) { ?>
            <button type="button" class="btn btn-sm btn-danger waves-effect" onclick="disableAccount(1)">
                <i class="material-icons">close</i>
                <span>Disable</span>
            </button>
            <?php } ?>
        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Status</th>
                    <td>
                        <?=issetor($info->disabled) == 0 ? 'Enabled' : 'Disabled'?> 
                    </td>
                </tr>
                <tr>
                    <th style="width: 25%;">Account Type</th>
                    <td style="width: 75%;">
                        <?=get_account_type()[issetor($info->type, 0)]?> 
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <?=issetor($info->username)?> 
                    </td>
                </tr>
            </tbody>
        </table>

        <?php } ?>
        
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="editName">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT NAME</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/save_name/')?>">
                <div class="form-horizontal modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Surname*</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="last_name" type="text" value="<?=issetor($info->last_name)?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">First Name*</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="first_name" type="text" value="<?=issetor($info->first_name)?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Extension Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="ext_name" type="text" value="<?=issetor($info->ext_name)?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Middle Name</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="middle_name" type="text" value="<?=issetor($info->middle_name)?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editName').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="changeImage">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">CHANGE PROFILE PICTURE</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/save_picture/')?>">
                <div class="form-horizontal modal-body">
                    <div class="form-group m-t-20">
                        <label class="col-md-12">Select File</label>
                        <div class="col-md-12">
                            <div class="form-line" id="input-file-upload">
                                <input type="file" name="file" class="form-control" accept="image/*" onchange="showImage(this)">
                                <div class="preloader pl-size-xs hide" style="position: absolute;top: 0;right: 0;">
                                    <div class="spinner-layer pl-red-grey">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 picture-preview hide m-t-20">
                            <div id="profile-picture" class="list-unstyled row clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#changeImage').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (in_array(get_user_type(), [-1, 0])) { ?>

<div class="modal fade in" data-backdrop="static" id="editDesignation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT DESIGNATION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/designation/')?>">
                <div class="form-horizontal modal-body">
                <div class="form-group">
                        <label class="col-md-12">Department*</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <select name="department_id" class="form-control show-tick" name="type" data-live-search="true">
                                    <option selected disabled>-- Select Department --</option>

                                    <?php foreach($info->departments as $department) {?>

                                    <option value="<?=$department->id?>" <?=$department->id == $info->department_id ? 'selected' : ''?>><?=$department->name?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Position*</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <select name="position_id" class="form-control show-tick" name="type" data-live-search="true">
                                    <option selected disabled>-- Select Position --</option>

                                    <?php foreach($info->positions as $position) {?>

                                        <option value="<?=$position->id?>" <?=$position->id == $info->position_id ? 'selected' : ''?>><?=$position->name?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Date Employed*</label>
                        <div class="col-md-12">
                            <div class="form-line demo-masked-input">
                                <input name="date_employed" type="text" value="<?=empty($info->date_employed) ? '' : date('m/d/Y', strtotime($info->date_employed))?>" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Type*</label>
                        <div class="col-md-12">
                            <div class="demo-radio-button">
                            
                                <?php foreach(get_all_job_status() as $job_id => $job_name) {?>

                                <input name="job_status" type="radio" id="radio_job_<?=$job_id?>" class="with-gap" value="<?=$job_id?>" <?=$job_id == $info->job_status ? 'checked' : ''?>>
                                <label for="radio_job_<?=$job_id?>"><?=$job_name?></label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                                <div class="form-group regular-employee" <?php if ($info->job_status != 1) { ?>style="display: none" <?php } ?>>
                        <label class="col-md-12">Regular Date</label>
                        <div class="col-md-12">
                            <div class="form-line demo-masked-input">
                                <input name="regular_date" type="text" value="<?=empty($info->regular_date) ? '' : date('m/d/Y', strtotime($info->date_employed))?>" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Status*</label>
                        <div class="col-md-12">
                            <div class="demo-radio-button">
                            
                                <?php foreach(get_all_employment_status() as $emp_id => $emp_name) {?>

                                <input name="emp_status" type="radio" id="radio_emp_<?=$emp_id?>" class="with-gap" value="<?=$emp_id?>" <?=$emp_id == $info->emp_status ? 'checked' : ''?>>
                                <label for="radio_emp_<?=$emp_id?>"><?=$emp_name?></label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editDesignation').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php if (in_array(get_user_type(), [-1]) || get_user_data()['id'] == $user_id) { ?>

<div class="modal fade in" data-backdrop="static" id="editAccount">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT ACCOUNT</h4>
            </div>
            <form action="<?=base_url('Account/update_account/')?>">
                <div class="form-horizontal modal-body">

                    <?php if (in_array(get_user_type(), [-1]) && get_user_data()['id'] != $user_id) { ?>

                    <div class="row">
                        <div class="col-md-12 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Type*</label>
                                <div class="col-md-12">
                                    <div class="demo-radio-button">
                                        <input name="type" type="radio" id="radio_regular" class="with-gap" value="1" <?=$info->type == 1 ? 'checked' : ''?>>
                                        <label for="radio_regular">Regular Account</label>
                                        <input name="type" type="radio" id="radio_admin" class="with-gap" value="0" <?=$info->type == 0 ? 'checked' : ''?>>
                                        <label for="radio_admin">Admin Account</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                    
                    <div class="form-group">
                        <label class="col-md-12">Username*</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="username" type="text" value="<?=issetor($info->username)?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Password*</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="password" type="password" value="" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Retype password*</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="confirm" type="password" value="" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editAccount').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php } ?>

<style>
.table th, .table td {
    vertical-align: middle !important;
}
</style>