<div class="card">
    <div class="header">
        <h2>
            <?php if (in_array(get_user_type(), [-1, 0])) {
                echo $page_title;      
            } ?>
            
            <button type="button" class="btn btn-primary waves-effect" onclick="$('#addModal').modal('show')">
                <i class="material-icons">add</i>
                <span>Add</span>
            </button>
        </h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">#</th>
                        <th colspan="2" class="text-center">Inclusive Dates</th>
                        <th rowspan="2" class="text-center">Position Title</th>
                        <th rowspan="2" class="text-center">Department/Agency/Office/Company</th>
                        <th rowspan="2" class="text-center">Monthly Salary</th>
                        <th rowspan="2" class="text-center">Salary/Job/Pay Grade & Step/Increment</th>
                        <th rowspan="2" class="text-center">Status of Appointment</th>
                        <th rowspan="2" class="text-center">Government Service</th>
                        <th rowspan="2" style="min-width: 110px;"></th>
                    </tr>
                    <tr>
                        <th class="text-center">From</th>
                        <th class="text-center">To</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($info)) { ?>
                    <tr>
                        <td class="text-center text-danger" colspan="10">No data.</td>
                    </tr>
                    <?php } ?>

                    <?php foreach ($info as $key => $experience) { ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$experience->from?></td>
                        <td><?=$experience->to?></td>
                        <td><?=$experience->position?></td>
                        <td><?=$experience->department?></td>
                        <td><?=$experience->salary?></td>
                        <td><?=$experience->salary_grade?></td>
                        <td><?=$experience->status?></td>
                        <td><?=$experience->govt?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                onclick='editForm(<?=htmlspecialchars(json_encode($experience))?>)'
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Edit">
                                <i class="material-icons">edit</i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                onclick="deleteData('<?=$experience->id?>')"
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


<div class="modal fade in" data-backdrop="static" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">ADD WORK EXPERIENCE</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_work_experience/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12">Inclusive Dates</label>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">From</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="from" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">To</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="to" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Position Title (Write in full/Do not abbreviate)</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="position" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Department/Agency/Office/Company (Write in full/Do not abbreviate)</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="department" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Monthly Salary</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="salary" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Salary/Job/Pay Grade (if applicable) & Step (Format "00-0")/Increment</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="salary_grade" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Status of Appointment</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="status" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Government Service</label>
                                <div class="col-md-12">
                                    <div class="demo-radio-button">
                                        <input name="govt" type="radio" id="radio_govt_1-1" class="with-gap" value="Yes" checked>
                                        <label for="radio_govt_1-1">Yes</label>
                                        
                                        <input name="govt" type="radio" id="radio_govt_2-1" class="with-gap" value="No">
                                        <label for="radio_govt_2-1" style="min-width: auto;">No</label>
                                    </div>
                                </div>
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
                <h4 class="modal-title" id="defaultModalLabel">EDIT WORK EXPERIENCE</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/work_experience/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12">Inclusive Dates</label>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">From</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="from" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">To</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="to" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Position Title (Write in full/Do not abbreviate)</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="position" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Department/Agency/Office/Company (Write in full/Do not abbreviate)</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="department" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Monthly Salary</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="salary" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Salary/Job/Pay Grade (if applicable) & Step (Format "00-0")/Increment</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="salary_grade" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Status of Appointment</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="status" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Government Service</label>
                                <div class="col-md-12">
                                    <div class="demo-radio-button">
                                        <input name="govt" type="radio" id="radio_govt_1-2" class="with-gap" value="Yes" checked>
                                        <label for="radio_govt_1-2">Yes</label>
                                        
                                        <input name="govt" type="radio" id="radio_govt_2-2" class="with-gap" value="No">
                                        <label for="radio_govt_2-2" style="min-width: auto;">No</label>
                                    </div>
                                </div>
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