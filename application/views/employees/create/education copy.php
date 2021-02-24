<style>
/* .table .form-group {
    margin-bottom: 0;
}
.modal .col-xs-12, .modal .col-sm-12, .modal .col-md-12, .modal .col-lg-12 {
    margin-bottom: 20px !important;
} */
</style>
<div class="form-horizontal table-responsive">
    <table class="table table-form table-condensed table-hover table-bordered education">
        <thead style="text-align: center">
            <tr>
                <th rowspan="2">Level</th>
                <th rowspan="2">Name of School</th>
                <th rowspan="2">Basic Education/Degree/Course</th>
                <th colspan="2">Period of Attendace</th>
                <th rowspan="2">Highest Level/Units Earned</th>
                <th rowspan="2">Year Graduated</th>
                <th rowspan="2">Scholarship/Academic Honors Received</th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            <tr style="display: none">
                <td>     
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_level[]" type="text" class="form-control">
                        </div>
                    </div>                          
                </td>
                <td>             
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_school[]" type="text" class="form-control">
                        </div>
                    </div>   
                </td>
                <td>           
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_course[]" type="text" class="form-control">
                        </div>
                    </div>   
                </td>
                <td>        
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_from[]" type="text" class="form-control">
                        </div>
                    </div>   
                </td>
                <td>        
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_to[]" type="text" class="form-control">
                        </div>
                    </div>   
                </td>
                <td>         
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_units[]" type="text" class="form-control">
                        </div>
                    </div>   
                </td>
                <td>          
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_graduated[]" type="text" class="form-control">
                        </div>
                    </div>   
                </td>
                <td> 
                    <div class="form-group"> 
                        <div class="form-line">
                            <input name="education_honors[]" type="text" class="form-control">
                        </div>
                    </div>   
                </td>
                <td>
                    <button 
                        type="button" 
                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float remove-table-row">
                        <i class="material-icons">close</i>
                    </button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9">
                    <button type="button" class="btn btn-primary waves-effect" onclick="showAddEducation()">
                        <i class="material-icons">add</i>
                        <span>Add Education</span>
                    </button>
                </td>
            </tr>
            
        </tfoot>
    </table>
</div>

<div class="modal fade in" data-backdrop="static" id="add-education">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">ADD EDUCATION</h4>
            </div>
            <div class="form-horizontal modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-12">Level</label>
                            <div class="col-md-12">
                                <div class="form-line">
                                    <select id="edu_level" class="form-control show-tick">

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
                                    <input id="edu_school" type="text" value="" class="form-control">
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
                                    <input id="edu_course" type="text" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-12">Period of Attendance</label>
                            <div class="col-md-12">
                                <div class="form-line demo-masked-input">
                                    <input id="edu_period" type="text" class="form-control year" placeholder="yyyy - yyyy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-12">Highest Level/Units Erned</label>
                            <div class="col-md-12">
                                <div class="form-line">
                                    <input id="edu_units" type="text" value="" class="form-control">
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
                                <div class="form-line">
                                    <input id="edu_graduated" type="text" value="" class="form-control">
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
                                    <input id="edu_honor" type="text" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#add-education').modal('hide')">CANCEL</button>
                <button type="button" class="btn btn-success waves-effect insert-education" onclick="addEducation(this)">ADD</button>
            </div>
        </div>
    </div>
</div>

<script>
function showAddEducation () {
    $('#edu_level').val('Elementary');
    $('#edu_school').val('');
    $('#edu_course').val('');
    $('#edu_period').val('');
    $('#edu_units').val('');
    $('#edu_graduated').val('');
    $('#edu_honor').val('');
    $('#add-education').modal('show');
}

function addEducation (e) {
    $tableBody = $('.education tbody')
    $row = $tableBody.find('tr:first-child').html();
    $tableBody.append('<tr>' + $row + '</tr>');

    $lastRow = $tableBody.find('tr:last-child');
    $lastRow.find("input[name='education_level[]']").val($('#edu_level').val());
    $lastRow.find("input[name='education_school[]']").val($('#edu_school').val());
    $lastRow.find("input[name='education_course[]']").val($('#edu_course').val());

    var attendance = $('#edu_period').val().split(' - ');
    console.log(attendance)
    $lastRow.find("input[name='education_from[]']").val(attendance[0]);
    $lastRow.find("input[name='education_to[]']").val(attendance[1]);

    $lastRow.find("input[name='education_units[]']").val($('#edu_units').val());
    $lastRow.find("input[name='education_graduated[]']").val($('#edu_graduated').val());
    $lastRow.find("input[name='education_honor[]']").val($('#edu_honor').val());
    $lastRow.show();
    $('#add-education').modal('hide');
}
</script>