
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
                                <th>Date</th>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>Date Applied</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><?=$value->employee_name?></td>
                                <td><?=$value->date?></td>
                                <td><?=$value->type_name?></td>
                                <td><?=$value->reason?></td>
                                <td><?=$value->create_time?></td>
                                <td><?=get_leave_status($value->status)?></td>
                                <td style="width: 20%">
                                    <?php if ($value->status != 1 && $value->status == 0) { ?>

                                    <button 
                                        onclick="actionRequest(<?=$value->id?>, 1)"
                                        type="button" 
                                        class="btn btn-success btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Approve">
                                        <i class="material-icons">check</i>
                                    </button>
                                    <?php } ?>

                                    <?php if ($value->status != 2 && $value->status == 0) { ?>

                                    <button 
                                        onclick="actionRequest(<?=$value->id?>, 2)"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Reject">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <?php } ?>

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
                                    <?php } ?>

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
                                <h4 class="modal-title">LEAVE REQUEST</h4>
                            </div>
                            <form class="form-horizontal" action="<?=base_url('leaves/Leave_requests/action')?>">
                                <input type="hidden" name="id" class="hide">
                                <input type="hidden" name="status" class="hide">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-md-12">Remarks</label>
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <textarea name="remarks" rows="5" class="form-control"></textarea>
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
            </div>
        </div>
    </div>
</div>