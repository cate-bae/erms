
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2> &nbsp;
                    <a href="<?=base_url()?>assets/excel/Leave_form.xlsx" class="btn btn-primary waves-effect pull-right">
                        <i class="material-icons">file_download</i>
                        <span>Download Leave Form</span>
                    </a>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
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
                            foreach ($list as $key => $value) {    
                        ?>

                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$value->employee_name?></td>
                            <td><?=$value->date_filing?></td>
                            <td><?=$leave_types[$value->type]?></td>
                            <td><?=$value->date_from . ' - ' . $value->date_to?></td>
                            <td><?=$value->purpose?></td>
                            <td><?=issetor($value->recommendation, '--')?></td>
                            <td>
                                <?php if ($value->recommendation == '') { ?>

                                <button 
                                    onclick="actionRequest(<?=$value->id?>, 1)"
                                    type="button" 
                                    class="btn btn-success btn-circle waves-effect waves-circle waves-float"
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Action">
                                    <i class="material-icons">edit</i>
                                </button>
                                <?php } ?>

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

                                <button 
                                    onclick="deleteRequest(<?=$value->id?>)"
                                    type="button" 
                                    class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Delete">
                                    <i class="material-icons">delete</i>
                                </button>
                                
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
                <div class="modal fade in" data-backdrop="static" id="actionModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title">DETAILS OF ACTION ON APPLICATION</h4>
                            </div>
                            <form class="form-horizontal" action="<?=base_url('leaves/Leave_requests/action')?>">
                                <input type="hidden" name="id" class="hide">
                                <div class="modal-body">
                                    <div class="form-group m-b-0">
                                        <div class="col-md-12 m-b-0">
                                            <div class="input-group m-b-0 demo-masked-input">
                                                <span class="input-group-addon">Leave Credits as of</span>
                                                <div class="form-line">
                                                    <input name="leave_credit_as_of" type="text" class="form-control date" placeholder="mm/dd/yyyy" value="<?=date('m/d/Y')?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-1 m-b-0"></div>
                                        <div class="col-md-11 m-b-0">
                                            <div class="input-group m-b-0">
                                                <span class="input-group-addon">Vacation</span>
                                                <div class="form-line">
                                                    <input name="vacation" type="number" class="form-control">
                                                </div>
                                            </div>    
                                        </div>    
                                        <div class="col-md-1 m-b-0"></div>
                                        <div class="col-md-11 m-b-0">
                                            <div class="input-group m-b-0">
                                                <span class="input-group-addon">Sick</span>
                                                <div class="form-line">
                                                    <input name="sick" type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 m-b-0"></div>
                                        <div class="col-md-11 m-b-0">
                                            <div class="input-group m-b-0">
                                                <span class="input-group-addon">CTO</span>
                                                <div class="form-line">
                                                    <input name="cto" type="number" class="form-control">
                                                </div>
                                            </div>    
                                        </div>    
                                        <div class="col-md-1 m-b-0"></div>
                                        <div class="col-md-11 m-b-0">
                                            <div class="input-group m-b-0">
                                                <span class="input-group-addon">SPL</span>
                                                <div class="form-line">
                                                    <input name="spl" type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 m-b-0"></div>
                                        <div class="col-md-11 m-b-0">
                                            <div class="input-group m-b-0">
                                                <span class="input-group-addon">Solo Parent</span>
                                                <div class="form-line">
                                                    <input name="solo_parent" type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Recommendation</label>                                                    
                                        <div class="col-md-12 m-l-30 m-b-0">
                                            <input name="recommendation" type="radio" id="approval" class="radio-col-teal" checked value="Approval"/>
                                            <label for="approval">Approval</label>
                                            <div class="approval">
                                                <div class="form-group m-b-0">
                                                    <label class="col-md-12">Approved for</label>
                                                    <div class="col-md-6">
                                                        <div class="input-group m-b-0">
                                                            <div class="form-line">
                                                                <input name="days_with_pay" type="number" class="form-control">
                                                            </div>
                                                            <span class="input-group-addon">days with pay</span>
                                                        </div>    
                                                    </div>    
                                                    <div class="col-md-6">
                                                        <div class="input-group m-b-0">
                                                            <div class="form-line">
                                                                <input name="days_without_pay" type="number" class="form-control">
                                                            </div>
                                                            <span class="input-group-addon">days without pay</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <input name="recommendation" type="radio" id="disapproval" class="radio-col-teal" value="Disapproval"/>
                                            <label for="disapproval">Disapproval</label>

                                            <div class="disapproval" style="display:none">
                                                <div class="form-group m-b-0">
                                                    <label class="col-md-12">Disapproval due to</label>
                                                    <div class="col-md-12">
                                                        <div class="form-line">
                                                            <input name="disapproval_reason" type="text" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <label class="col-md-12">Disapproved due to</label>
                                                    <div class="col-md-12">
                                                        <div class="form-line">
                                                            <input name="disapproved_reason" type="text" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Department Head</label>
                                        
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <select name="dept_head_id" class="form-control show-tick leave_type">

                                                <?php foreach($employees as $id => $name) {?>

                                                    <option value="<?=$id?>"><?=get_name($name)?></option>
                                                <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Authorized Officer</label>
                                        
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <select name="authorized_officer_id" class="form-control show-tick leave_type">

                                                <?php foreach($employees as $id => $name) {?>

                                                <option value="<?=$id?>"><?=get_name($name)?></option>
                                                <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#actionModal').modal('hide')">CANCEL</button>
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
                                    <tr class="view_approval">
                                        <th>Approved for</th>
                                        <td id="view_approval"></td>
                                    </tr>
                                    <tr class="view_disapproval">
                                        <th>Disapproval due to</th>
                                        <td id="view_disapproval_reason"></td>
                                    </tr>
                                    <tr class="view_disapproval">
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
            </div>
        </div>
    </div>
</div>