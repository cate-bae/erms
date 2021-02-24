<div class="card">
    <div class="header">
        <h2>
            <?php if (in_array(get_user_type(), [-1, 0])) {
                echo $page_title;      
            } ?>
            
            <?php if (count($info) < 3) { ?>

            <button type="button" class="btn btn-primary waves-effect pull-right" onclick="$('#addModal').modal('show')">
                <i class="material-icons">add</i>
                <span>Add</span>
            </button>
            <?php } ?>

        </h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Telephone No.</th>
                        <th style="min-width: 110px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($info)) { ?>
                    <tr>
                        <td class="text-center text-danger" colspan="5">No data.</td>
                    </tr>
                    <?php } ?>

                    <?php foreach ($info as $key => $reference) { ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$reference->name?></td>
                        <td><?=$reference->address?></td>
                        <td><?=$reference->telephone?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                onclick='editForm(<?=json_encode($reference)?>)'
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Edit">
                                <i class="material-icons">edit</i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                onclick="deleteData('<?=$reference->id?>')"
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
                <h4 class="modal-title" id="defaultModalLabel">ADD REFERENCE</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_reference/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="address" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Telephone</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="telephone" type="text" value="" class="form-control">
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
                <h4 class="modal-title" id="defaultModalLabel">EDIT REFERENCE</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/reference/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="address" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Telephone</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="telephone" type="text" value="" class="form-control">
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