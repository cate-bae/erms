
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <button 
                            onclick="addBenefit()"
                            type="button" 
                            class="btn btn-success waves-effect pull-right">
                            <i class="material-icons">add</i>
                            <span>ADD BENEFIT</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agency</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                            <tr id="account-<?=$value->id?>">
                                <td><?=$key+1?></td>
                                <td><?=$value->name?></td>
                                <td style="width: 20%">
                                    <button 
                                        onclick="editBenefit(<?=$value->id?>, '<?=$value->name?>')"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Edit">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button 
                                        onclick="deleteBenefit(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
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
                <div class="modal fade in" data-backdrop="static" id="addModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue p-t-15 p-b-15">
                                <h4 class="modal-title">ADD BENEFIT</h4>
                            </div>
                            <form action="<?=base_url('Benefits/add')?>" class="form-horizontal" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-md-12">Name</label>
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <input name="name" type="text" value="" class="form-control">
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
                                <h4 class="modal-title">EDIT BENEFIT</h4>
                            </div>
                            <form class="form-horizontal" action="<?=base_url('Benefits/update')?>">
                                <input type="hidden" name="id" class="hide">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-md-12">Agency</label>
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <input name="name" type="text" value="" class="form-control" id="department_name">
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
            </div>
        </div>
    </div>
</div>