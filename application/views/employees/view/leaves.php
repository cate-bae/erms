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

        <!-- <table>
            <tr>
                <td width="20%">Total leave credit: <?=(double)$info['leave_info']->leave?></td>
                <td width="20%">Used: <?=(double)$info['leave_info']->leave_used?></td>
                <td width="20%">Left: <?=(double)$info['leave_info']->leave - (double)$info['leave_info']->leave_used?></td>
            </tr>
        </table> -->

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date of Filing</th>
                        <th>Type of Leave</th>
                        <th>Inclusive Dates</th>
                        <th>Purpose</th>
                        <th>Recommendation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $leave_types = leave_types();  
                        foreach ($info['leaves'] as $key => $value) {    
                    ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$value->date_filing?></td>
                        <td><?=$leave_types[$value->type]?></td>
                        <td><?=$value->date_from . ' - ' . $value->date_to?></td>
                        <td><?=$value->purpose?></td>
                        <td><?=$value->recommendation?></td>
                        <td>

                            <button 
                                onclick="viewRemarks('<?=$value->id?>')"
                                type="button" 
                                class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="View Info">
                                <i class="material-icons">note</i>
                            </button>
                            <?php if (get_user_data()['id'] == $user_id) { ?>
                            
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
                <h4 class="modal-title" id="defaultModalLabel">DETAILS OF APPLICATION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_leave/')?>">
                <div class="form-horizontal modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Office/Agency</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="agency" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12">Date of Filing</label>
                                <div class="col-md-12">
                                    <div class="form-line demo-masked-input">
                                        <input name="date_filing" type="text" class="form-control date" placeholder="mm/dd/yyyy" value="<?=date('m/d/Y')?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12">Salary</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="salary" type="text" value="" class="form-control decimal">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Type of Leave</label>

                        
                        <div class="col-md-12">
                            <div class="form-line">
                                <select name="type" class="form-control show-tick leave_type">

                                <?php foreach($leave_types as $key => $type) {?>

                                    <option value="<?=$key?>"><?=$type?></option>
                                <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="m-l-30 leave-vacation">
                            <div class="col-md-12">
                                <input name="type_vacation" type="radio" id="leave_00" class="radio-col-teal" checked value="To seek employment"/>
                                <label for="leave_00">To seek employment</label>
                            </div>
                            <div class="col-md-12">
                                <input name="type_vacation" type="radio" id="leave_01" class="radio-col-teal" value="Others (Specify)"/>
                                <label for="leave_01">Others (Specify)</label>
                                <div class="form-line vacation-others" style="display:none">
                                    <input name="type_vacation_others" type="text" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="m-l-30 leave-others" style="display:none">
                            <div class="col-md-12">
                                <input name="type_others" type="radio" id="leave_10" class="radio-col-teal" checked value="CTO"/>
                                <label for="leave_10">CTO</label>
                                
                                <input name="type_others" type="radio" id="leave_11" class="radio-col-teal" value="SPL"/>
                                <label for="leave_11">SPL</label>
                                
                                <input name="type_others" type="radio" id="leave_12" class="radio-col-teal" value="Solo Parent"/>
                                <label for="leave_12">Solo Parent</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group location">
                        <label class="col-md-12">Where leave will be spent:</label>
                        <div class="m-l-30 leave-vacation">
                            <div class="col-md-12">
                                <input name="location" type="radio" id="within_ph" class="radio-col-teal" checked value="Within the Philippines"/>
                                <label for="within_ph">Within the Philippines</label>
                            </div>
                            <div class="col-md-12">
                                <input name="location" type="radio" id="abroad" class="radio-col-teal" value="Abroad (Specify)"/>
                                <label for="abroad">Abroad (Specify)</label>
                                <div class="form-line abroad" style="display:none">
                                    <input name="location_abroad" type="text" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="m-l-30 leave-sick" style="display:none">
                            <div class="col-md-12">
                                <input type="checkbox" name="location_sick" id="in_hospital" class="filled-in in_hospital" value="1"/>
                                <label for="in_hospital">In hospital (Specify)</label>
                                <div class="form-line in_hospital" style="display:none">
                                    <input name="location_sick_hospital" type="text" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Number of working days applied for:</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="days" type="number" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Inclusive Dates</label>
                        <div class="col-md-12">
                        
                            <div class="input-group m-b-0">
                                <div class="form-line demo-masked-input">
                                    <input name="date_from" type="text" class="form-control date" placeholder="mm/dd/yyyy" value="">
                                </div>                 
                                <span class="input-group-addon p-r-10">to &nbsp;</span>
                                <div class="form-line demo-masked-input">
                                    <input name="date_to" type="text" class="form-control date" placeholder="mm/dd/yyyy" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Purpose</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="purpose" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-12">Commutation</label>
                        
                        <div class="col-md-12">
                            <input name="commutation" type="radio" id="reaquested" class="radio-col-teal" checked value="Requested"/>
                            <label for="reaquested">Requested</label>
                            
                            <input name="commutation" type="radio" id="not_requested" class="radio-col-teal" value="Not Requested"/>
                            <label for="not_requested">Not Requested</label>
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

<div class="modal fade in" data-backdrop="static" id="remarksModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title">DETAILS OF APPLICATION</h4>
            </div>
            <div class="form-horizontal modal-body">
                <table class="table table-bordered table-condensed table-hover">
                    <tr>
                        <th colspan="2" class="text-center">APPLICATION FOR LEAVE</th>
                    </tr>
                    <tr>
                        <th width="30%">Office/Agency</th>
                        <td width="70%" id="view_agency"></td>
                    </tr>
                    <tr>
                        <th width="30%">Name</th>
                        <td width="70%" id="view_name"></td>
                    </tr>
                    <tr>
                        <th>Date of Filing</th>
                        <td id="view_date_filing"><?=date('m/d/Y')?></td>
                    </tr>
                    <tr>
                        <th width="30%">Position</th>
                        <td width="70%" id="view_position"></td>
                    </tr>
                    <tr>
                        <th>Salary</th>
                        <td id="view_salary">0.00</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">DETAILS OF APPLICATION</th>
                    </tr>
                    <tr>
                        <th>Type of Leave</th>
                        <td id="view_type"></td>
                    </tr>
                    <tr class="view_location">
                        <th>Where leave will be spent</th>
                        <td id="view_location"></td>
                    </tr>
                    <tr>
                        <th>Number of working days applied for</th>
                        <td id="view_days">0</td>
                    </tr>
                    <tr>
                        <th>Inclusive Dates</th>
                        <td id="view_inclusive_dates">01/21/2021 - 01/22/2021</td>
                    </tr>
                    <tr>
                        <th>Purpose</th>
                        <td id="view_purpose"></td>
                    </tr>
                    <tr>
                        <th>Commutation</th>
                        <td id="view_commutation"></td>
                    </tr>

                    <tr>
                        <th colspan="2" class="text-center">DETAILS OF ACTION ON APPLICATION</th>
                    </tr>

                    <tr>
                        <th colspan="2">Certification of Leave Credits as of <span id="view_leave_credits_as_of"></span></th>
                    </tr>
                    <tr>
                        <th>Vacation</th>
                        <td id="view_vacation"></td>
                    </tr>
                    <tr>
                        <th>Sick</th>
                        <td id="view_sick"></td>
                    </tr>
                    <tr>
                        <th>CTO</th>
                        <td id="view_cto"></td>
                    </tr>
                    <tr>
                        <th>SPL</th>
                        <td id="view_spl"></td>
                    </tr>
                    <tr>
                        <th>Solo Parent</th>
                        <td id="view_solo_parent"></td>
                    </tr>
                    <tr>
                        <th>Recommendation</th>
                        <td id="view_recommendation"></td>
                    </tr>
                    <tr class="approval">
                        <th>Approved for</th>
                        <td id="view_approval"></td>
                    </tr>
                    <tr class="disapproval">
                        <th>Disapproval due to</th>
                        <td id="view_disapproval_reason"></td>
                    </tr>
                    <tr class="disapproval">
                        <th>Disapproved due to</th>
                        <td id="view_disapproved_reason"></td>
                    </tr>
                    <tr>
                        <th>Department Head</th>
                        <td id="view_dept_head"></td>
                    </tr>
                    <tr>
                        <th>Authorized Official</th>
                        <td id="view_authorized_officer"></td>
                    </tr>
                </table>
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