<div class="card">
    <?php if (in_array(get_user_type(), [-1, 0])) { ?>

    <div class="header">
        <h2>
            <?=$page_title?>
        </h2>
    </div>   
    <?php } ?>

    <div class="body">
        <form id="form-spouse" action="<?=base_url('employee/Update_employee/spouse/')?>">
        <h2 class="card-inside-title">
            SPOUSE
            <button type="button" class="btn btn-warning waves-effect edit-button" onclick="enableFields('form-spouse')">
                <i class="material-icons">edit</i>
                <span>Edit</span>
            </button>
            <button type="button" class="btn btn-default waves-effect cancel-button" onclick="location.reload()" style="display: none">
                <i class="material-icons">close</i>
                <span>Cancel</span>
            </button>
        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Surname</th>
                    <td colspan="3">
                        <input name="spouse_surname" type="text" class="form-control" value="<?=issetor($info['spouse']->surname)?>" disabled>
                    </td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>
                        <input name="spouse_first_name" type="text" class="form-control" value="<?=issetor($info['spouse']->first_name)?>" disabled>
                    </td>
                    <th>Name Extension</th>
                    <td>
                        <input name="spouse_ext_name" type="text" class="form-control" value="<?=issetor($info['spouse']->ext_name)?>" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Middle Name</th>
                    <td colspan="3">
                        <input name="spouse_middle_name" type="text" class="form-control" value="<?=issetor($info['spouse']->middle_name)?>" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Occupation</th>
                    <td colspan="3">
                        <input name="spouse_occupation" type="text" class="form-control" value="<?=issetor($info['spouse']->occupation)?>" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Employer/Business Name</th>
                    <td colspan="3">
                        <input name="spouse_business" type="text" class="form-control" value="<?=issetor($info['spouse']->business)?>" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Business Address</th>
                    <td colspan="3">
                        <input name="spouse_business_address" type="text" class="form-control" value="<?=issetor($info['spouse']->business_address)?>" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Telephone No.</th>
                    <td colspan="3">
                        <input name="spouse_telephone" type="text" class="form-control" value="<?=issetor($info['spouse']->telephone)?>" disabled>
                    </td>
                </tr>
            </tbody>
            <tfoot style="display: none" class="submit-button">
                <tr>
                    <td colspan="4">
                        <button type="submit" class="btn btn-success text-uppercase pull-right">
                            <i class="material-icons">save</i>
                            <span>Save</span>
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        
        </form>

        <form id="form-father" action="<?=base_url('employee/Update_employee/father/')?>">
        <h2 class="card-inside-title">
            FATHER
            <button type="button" class="btn btn-warning waves-effect edit-button" onclick="enableFields('form-father')">
                <i class="material-icons">edit</i>
                <span>Edit</span>
            </button>
            <button type="button" class="btn btn-default waves-effect cancel-button" onclick="location.reload()" style="display: none">
                <i class="material-icons">close</i>
                <span>Cancel</span>
            </button>
        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Surname</th>
                    <td colspan="3">
                        <input name="father_surname" value="<?=issetor($info['parents'][0]->surname)?>" type="text" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>
                        <input name="father_first_name" value="<?=issetor($info['parents'][0]->first_name)?>" type="text" class="form-control" disabled>
                    </td>
                    <th>Name Extension</th>
                    <td>
                        <input name="father_ext_name" value="<?=issetor($info['parents'][0]->ext_name)?>" type="text" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Middle Name</th>
                    <td colspan="3">
                        <input name="father_middle_name" value="<?=issetor($info['parents'][0]->middle_name)?>" type="text" class="form-control" disabled>
                    </td>
                </tr>
            </tbody>
            <tfoot style="display: none" class="submit-button">
                <tr>
                    <td colspan="4">
                        <button type="submit" class="btn btn-success text-uppercase pull-right">
                            <i class="material-icons">save</i>
                            <span>Save</span>
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        </form>

        <form id="form-mother" action="<?=base_url('employee/Update_employee/mother/')?>">
        <h2 class="card-inside-title">
            MOTHER
            <button type="button" class="btn btn-warning waves-effect edit-button" onclick="enableFields('form-mother')">
                <i class="material-icons">edit</i>
                <span>Edit</span>
            </button>
            <button type="button" class="btn btn-default waves-effect cancel-button" onclick="location.reload()" style="display: none">
                <i class="material-icons">close</i>
                <span>Cancel</span>
            </button>
        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Maiden Name</th>
                    <td colspan="3">
                        <input name="mother_maiden_name" value="<?=issetor($info['parents'][1]->maiden_name)?>" type="text" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Surname</th>
                    <td colspan="3">
                        <input name="mother_surname" value="<?=issetor($info['parents'][1]->surname)?>" type="text" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td colspan="3">
                        <input name="mother_first_name" value="<?=issetor($info['parents'][1]->first_name)?>" type="text" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Middle Name</th>
                    <td colspan="3">
                        <input name="mother_middle_name" value="<?=issetor($info['parents'][1]->middle_name)?>" type="text" class="form-control" disabled>
                    </td>
                </tr>
            </tbody>
            <tfoot style="display: none" class="submit-button">
                <tr>
                    <td colspan="4">
                        <button type="submit" class="btn btn-success text-uppercase pull-right">
                            <i class="material-icons">save</i>
                            <span>Save</span>
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        </form>
        
        <h2 class="card-inside-title">
            CHILDREN
            <button type="button" class="btn btn-primary waves-effect" onclick="$('#addModal').modal()">
                <i class="material-icons">add</i>
                <span>Add</span>
            </button>
        </h2>
        <?php if ($info['children']) { ?>

        <div class="table">
            <table class="table table-form table-condensed table-hover table-bordered children">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th style="min-width: 110px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($info['children'] as $key => $child) { ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$child->name?></td>
                        <td><?=date('m/d/Y', strtotime($child->birth_day))?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float edit-button" 
                                onclick="editForm('<?=$child->id?>', '<?=$child->name?>', '<?=date('m/d/Y', strtotime($child->birth_day))?>')"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Edit">
                                <i class="material-icons">edit</i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                onclick="deleteChild('<?=$child->id?>')"
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
        <?php } ?>
        
    </div>
</div>

<div class="modal fade in" data-backdrop="static" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue p-t-15 p-b-15">
                <h4 class="modal-title">EDIT CHILD</h4>
            </div>
            <form class="form-horizontal" action="<?=base_url('employee/Update_employee/child/')?>">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Name</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="name" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Date of Birth</label>
                        <div class="col-md-12">
                            <div class="form-line demo-masked-input">
                                <input name="birth_day" type="text" class="form-control date" placeholder="mm/dd/yyyy">
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

<div class="modal fade in" data-backdrop="static" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue p-t-15 p-b-15">
                <h4 class="modal-title">ADD CHILD</h4>
            </div>
            <form class="form-horizontal" action="<?=base_url('employee/Update_employee/add_child/')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Name</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="name" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Date of Birth</label>
                        <div class="col-md-12">
                            <div class="form-line demo-masked-input">
                                <input name="birth_day" type="text" class="form-control date" placeholder="mm/dd/yyyy">
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