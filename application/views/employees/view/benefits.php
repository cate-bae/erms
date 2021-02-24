<div class="card">
    
    <?php if ($info['can_have_benefits']) { ?>

    <?php if (in_array(get_user_type(), [-1, 0])) { ?>
    
        <div class="header">
            <h2>
                <?=$page_title?>     
                <button type="button" class="btn btn-primary waves-effect pull-right" onclick="$('#addModal').modal('show')">
                    <i class="material-icons">add</i>
                    <span>Add</span>
                </button>
            </h2>
        </div>
    <?php } ?>

    <?php } else { ?>
        <div class="header">
            <h2>Employee is not qualified to have benefits.</h2>
        </div>
    <?php } ?>

        
    <div class="body">
        <div class="table-responsive">
            <table class="table table-form table-condensed table-hover table-bordered js-basic-example">
                <thead>
                    <tr>
                        <th style="width: 20px">#</th>
                        <th>Benefit</th>
                        <?php if (in_array(get_user_type(), [-1, 0])) { ?>

                        <th>Actions</th>
                        <?php } ?>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($info['user_benefits'] as $key => $benefit_id) { 
                        
                        if ( ! empty($info['benefits'][$benefit_id])) { ?>

                    <tr>
                        <td><?=$key + 1?></td>
                        <td><?=$info['benefits'][$benefit_id]->name?></td>

                        <?php if (in_array(get_user_type(), [-1, 0])) { ?>

                        <td>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                onclick="deleteBenefit('<?=$benefit_id?>')"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Delete">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade in" data-backdrop="static" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EMPLOYEE BENEFIT</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_benefit/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        
                        <?php foreach ($info['benefits'] as $benefit) { ?>

                        <div class="col-sm-12">
                            <input type="checkbox" name="benefit_id[]" id="benefit_<?=$benefit->id?>" value="<?=$benefit->id?>" class="filled-in" <?=in_array($benefit->id, $info['user_benefits']) ? 'checked' : ''?>/>
                            <label for="benefit_<?=$benefit->id?>"><?=$benefit->name?></label>
                        </div>

                        <?php } ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#addRecognition').modal('hide')">CANCEL</button>
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