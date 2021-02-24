<style>
.card .body .form-group .col-xs-12, 
.card .body .form-group .col-sm-12, 
.card .body .form-group .col-md-12, 
.card .body .form-group .col-lg-12 {
    margin-bottom: 0;
}
</style>
<div class="row clearfix">

    <form>
    
    <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="header">                    
                <h2>
                    EMPLOYEE NAME
                </h2>
            </div>
            <div class="body">
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-7 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">First Name*</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="first_name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Extension Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="ext_name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Middle Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="middle_name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Surname*</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="last_name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="header">
                <h2>
                    DESIGNATION
                </h2>
            </div>
            <div class="body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12">Department*</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <select name="department_id" class="form-control show-tick" name="type" data-live-search="true">
                                    <option selected disabled>-- Select Department --</option>

                                    <?php foreach($departments as $department) {?>

                                    <option value="<?=$department->id?>"><?=$department->name?></option>
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

                                    <?php foreach($positions as $position) {?>

                                        <option value="<?=$position->id?>"><?=$position->name?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Date Employed*</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="date_employed" type="text" class="datepicker form-control" placeholder="Please choose a date...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Type*</label>
                        <div class="col-md-12">
                            <div class="demo-radio-button">
                            
                                <?php foreach($job_status as $job_id => $job_name) {?>

                                <input name="job_status" type="radio" id="radio_job_<?=$job_id?>" class="with-gap" value="<?=$job_id?>" <?=$job_id == 0 ? 'checked' : ''?>>
                                <label for="radio_job_<?=$job_id?>"><?=$job_name?></label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-md-12">Status*</label>
                        <div class="col-md-12">
                            <div class="demo-radio-button">
                            
                                <?php foreach($employment_status as $emp_id => $emp_name) {?>

                                <input name="emp_status" type="radio" id="radio_emp_<?=$emp_id?>" class="with-gap" value="<?=$emp_id?>" <?=$emp_id == 0 ? 'checked' : ''?>>
                                <label for="radio_emp_<?=$emp_id?>"><?=$emp_name?></label>
                                <?php } ?>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="header">
                <h2>
                    ACCOUNT SETTINGS
                </h2>
            </div>
            <div class="body">
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Type*</label>
                                <div class="col-md-12">
                                    <div class="demo-radio-button">
                                        <input name="type" type="radio" id="radio_regular" class="with-gap" value="1" checked>
                                        <label for="radio_regular">Regular Account</label>
                                        <input name="type" type="radio" id="radio_admin" class="with-gap" value="0">
                                        <label for="radio_admin">Admin Account</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Username*</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="username" type="text" value="" class="form-control">
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
                    <div class="form-group" id="btn-save">
                        <div class="col-sm-12">
                            <button class="btn btn-success text-uppercase pull-right">
                                <i class="material-icons">save</i>
                                <span>Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </form>
</div>