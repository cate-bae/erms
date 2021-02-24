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
                        <th rowspan="2" class="text-center">Career Service/RA 1080 (Board/Bar) under Special Laws/CES/CSEE Barangay Elegibility/Driver's License</th>
                        <th rowspan="2" class="text-center">Rating</th>
                        <th rowspan="2" class="text-center">Date of Examination/Conferment</th>
                        <th rowspan="2" class="text-center">Place of Examination/Conferment</th>
                        <th colspan="2" class="text-center">License</th>
                        <th rowspan="2" style="min-width: 110px;"></th>
                    </tr>
                    <tr>
                        <th class="text-center">Number</th>
                        <th class="text-center">Date of Validity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($info)) { ?>
                    <tr>
                        <td class="text-center text-danger" colspan="8">No data.</td>
                    </tr>
                    <?php } ?>

                    <?php foreach ($info as $key => $service) { ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$service->title?></td>
                        <td><?=$service->rating?></td>
                        <td><?=$service->date?></td>
                        <td><?=$service->place?></td>
                        <td><?=$service->license?></td>
                        <td><?=$service->validity?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                onclick="editForm(<?=htmlspecialchars(json_encode($service))?>)"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Edit">
                                <i class="material-icons">edit</i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                onclick="deleteService('<?=$service->id?>')"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Delete">
                                <i class="material-icons">delete</i>
                            </button></td>
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
                <h4 class="modal-title" id="defaultModalLabel">ADD SERVICE</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_civil_service/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Career Service/RA 1080 (Board/Bar) under Special Laws/CES/CSEE Barangay Elegibility/Driver's License</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="title" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Rating (If Applicable)</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="rating" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Date of Examination/Conferment</label>
                                <div class="col-md-12">
                                    <div class="form-line demo-masked-input">
                                        <input name="date" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Place of Examination/Conferment</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="place" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12">License (If Applicable)</label>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">Number</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="license" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">Date of Validity</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="validity" type="text" class="form-control">
                                        </div>
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
                <h4 class="modal-title" id="defaultModalLabel">EDIT EDUCATION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/civil_service/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Career Service/RA 1080 (Board/Bar) under Special Laws/CES/CSEE Barangay Elegibility/Driver's License</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="title" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Rating (If Applicable)</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="rating" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Date of Examination/Conferment</label>
                                <div class="col-md-12">
                                    <div class="form-line demo-masked-input">
                                        <input name="date" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Place of Examination/Conferment</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="place" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12">License (If Applicable)</label>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">Number</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="license" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">Date of Validity</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="validity" type="text" class="form-control">
                                        </div>
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