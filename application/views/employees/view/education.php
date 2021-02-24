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
                        <th rowspan="2" class="text-center">Level</th>
                        <th rowspan="2" class="text-center">Name of School</th>
                        <th rowspan="2" class="text-center">Basic Education/Degree/Course</th>
                        <th colspan="2" class="text-center">Period of Attendance</th>
                        <th rowspan="2" class="text-center">Highest Level/Units Earned</th>
                        <th rowspan="2" class="text-center">Year Graduated</th>
                        <th rowspan="2" class="text-center">Scholarship/ Academic Honors Received</th>
                        <th rowspan="2" style="min-width: 110px;"></th>
                    </tr>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($info)) { ?>
                    <tr>
                        <td class="text-center text-danger" colspan="10">No data.</td>
                    </tr>
                    <?php } ?>

                    <?php foreach ($info as $key => $education) { ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$education->level?></td>
                        <td><?=$education->school?></td>
                        <td><?=$education->course?></td>
                        <td><?=$education->from?></td>
                        <td><?=$education->to?></td>
                        <td><?=$education->units?></td>
                        <td><?=$education->year?></td>
                        <td><?=$education->honors?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                onclick='editForm(<?=json_encode($education)?>)'
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="" 
                                data-original-title="Edit">
                                <i class="material-icons">edit</i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                onclick="deleteEducation('<?=$education->id?>')"
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
                <h4 class="modal-title" id="defaultModalLabel">ADD EDUCATION</h4>
            </div>
            <form action="<?=base_url('employee/Update_employee/add_education/')?>">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Level</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <select name="level" class="form-control show-tick">

                                        <?php foreach(get_education_levels() as $level) {?>

                                            <option value="<?=$level?>"><?=$level?></option>
                                        <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Name of School</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="school" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Basic Education/Degree/Course</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="course" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12">Period of Attendance</label>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">From</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="from" type="text" class="form-control year" placeholder="yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">To</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="to" type="text" class="form-control year" placeholder="yyyy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Highest Level/Units Earned</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="units" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Year Graduated</label>
                                <div class="col-md-12">
                                    <div class="form-line demo-masked-input">
                                        <input name="year" type="text" class="form-control year" placeholder="yyyy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Scholarship/Academic Honors Received</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="honors" type="text" value="" class="form-control">
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
            <form action="<?=base_url('employee/Update_employee/education/')?>">
                <input type="hidden" name="id">
                <div class="form-horizontal modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Level</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <select name="level" class="form-control show-tick">

                                        <?php foreach(get_education_levels() as $level) {?>

                                            <option value="<?=$level?>"><?=$level?></option>
                                        <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Name of School</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="school" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Basic Education/Degree/Course</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="course" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12">Period of Attendance</label>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">From</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="from" type="text" class="form-control year" placeholder="yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group m-b-0">
                                        <span class="input-group-addon">To</span>
                                        <div class="form-line demo-masked-input">
                                            <input name="to" type="text" class="form-control year" placeholder="yyyy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Highest Level/Units Earned</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="units" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Year Graduated</label>
                                <div class="col-md-12">
                                    <div class="form-line demo-masked-input">
                                        <input name="year" type="text" class="form-control year" placeholder="yyyy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Scholarship/Academic Honors Received</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="honors" type="text" value="" class="form-control">
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