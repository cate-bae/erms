<div class="card">
    <div class="header">
        <h2>
            <?php if (issetor($info['general']->job_status, 0) == 0) {
                echo 'Employee not qualified to file leave.';
            } 
            elseif (in_array(get_user_type(), [-1, 0])) {
                echo $page_title;      
            } ?>
            
            <?php if (get_user_data()['id'] == $user_id && issetor($info['general']->job_status, 0) != 0) { ?>
            
            <button type="button" class="btn btn-primary waves-effect pull-right" onclick="$('#addModal').modal('show')">
                <i class="material-icons">add</i>
                <span>REQUEST LEAVE</span>
            </button>
            <?php } ?>
        
            <a href="<?=base_url()?>assets/excel/Leave_form.xlsx" class="btn btn-primary waves-effect">
                <i class="material-icons">file_download</i>
                <span>Download Leave Form</span>
            </a>
            
        </h2>
        
    </div>
    <div class="body">

        <table>
            <tr>
                <td width="20%">Total leave credit: <?=(double)$info['leave_info']->leave?></td>
                <td width="20%">Used: <?=(double)$info['leave_info']->leave_used?></td>
                <td width="20%">Left: <?=(double)$info['leave_info']->leave - (double)$info['leave_info']->leave_used?></td>
            </tr>
        </table>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($info['leaves'] as $key => $value) { ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$value->date?></td>
                        <td><?=$value->type_name?></td>
                        <td><?=$value->reason?></td>
                        <td><?=$value->create_time?></td>
                        <td><?=get_leave_status($value->status)?></td>
                        <td><?=issetor($value->paid) == 1 ? 'Yes' : 'No'?></td>
                        <td>
                            <?php if (in_array($value->status, [1,2])) { ?>

                            <button 
                                onclick="viewRemarks('<?=$value->remarks?>')"
                                type="button" 
                                class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="View Remarks">
                                <i class="material-icons">note</i>
                            </button>
                            <?php } else if (get_user_data()['id'] == $user_id) { ?>
                            
                            <!-- <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                onclick='editLeave(<?=json_encode($value)?>)'
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Edit">
                                <i class="material-icons">edit</i>
                            </button> -->
                            <button 
                                type="button" 
                                class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                onclick="deleteLeave('<?=$value->id?>')"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Delete">
                                <i class="material-icons">delete</i>
                            </button>

                            <?php } ?>
                            <a href="<?=base_url()?>employee/Export_leave/index/<?=$value->id?>" 
                                class="btn btn-primary btn-circle waves-effect waves-circle waves-float delete-button"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Download Form">
                                <i class="material-icons">print</i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>


<div class="modal fade in" data-backdrop="static" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">REQUEST LEAVE</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_leave/')?>">
                <div class="form-horizontal modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Date</label>
                        <div class="col-md-12">
                            <div class="form-line demo-masked-input">
                                <input name="date" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Type</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <select name="type" class="form-control show-tick">

                                <?php foreach($info['types'] as $type) {?>

                                    <option value="<?=$type->id?>"><?=$type->name?></option>
                                <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="checkbox" name="use_leave_credit" id="use_leave_credit" class="filled-in"/>
                            <label for="use_leave_credit">Use Leave Credit</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Reason</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="reason" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#addModal').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade in" data-backdrop="static" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT ATTENDANCE</h4>
            </div>
            <form action="<?=base_url('Attendance/update/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                    <div class="form-group m-b-0">
                        <label class="col-md-12 m-b-10">Employee</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <select name="user_id" class="form-control show-tick" data-live-search="true">

                                <?php foreach($employees as $employee) {?>

                                    <option value="<?=$employee->id?>"><?=$employee->name?></option>
                                <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <label class="col-md-12 m-b-10">Date</label>
                        <div class="col-md-12">
                            <div class="form-line demo-masked-input">
                                <input name="date" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <label class="col-md-12 m-b-10">Time In</label>
                        <div class="col-md-12">
                            <div class="form-line time-masked-input">
                                <input name="time_in" type="text" class="form-control time" placeholder="HH:MM am">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <label class="col-md-12 m-b-10">Break</label>
                        <div class="col-md-12">
                            <div class="form-line time-masked-input">
                                <input name="break" type="text" class="form-control time" placeholder="HH:MM pm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <label class="col-md-12 m-b-10">Resume</label>
                        <div class="col-md-12">
                            <div class="form-line time-masked-input">
                                <input name="resume" type="text" class="form-control time" placeholder="HH:MM pm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <label class="col-md-12 m-b-10">Time Out</label>
                        <div class="col-md-12">
                            <div class="form-line time-masked-input">
                                <input name="time_out" type="text" class="form-control time" placeholder="HH:MM pm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editModal').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="remarksModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title">Remarks</h4>
            </div>
            <div class="modal-body">
                <div class="remarks"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#actionModal').modal('hide')">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<style>
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