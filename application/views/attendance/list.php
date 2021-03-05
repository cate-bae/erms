<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <button 
                            onclick="addAttendance()"
                            type="button" 
                            class="btn btn-success waves-effect">
                            <i class="material-icons">add</i>
                            <span>ADD</span>
                        </button>

                        <!-- <button type="button" 
                            class="btn btn-primary waves-effect" 
                            onclick="$('#uploadModal').modal('show')">
                            <i class="material-icons">file_upload</i>
                            <span>UPLOAD</span>
                        </button> -->

                        <!-- <a type="button" 
                            class="btn btn-info waves-effect" 
                            target="_blank"
                            href="<?=base_url('attendance_excel/Export_attendance/attendance')?>">
                            <i class="material-icons">print</i>
                            <span>EXPORT</span>
                        </a> -->
                                    
                        <button type="button" 
                            class="btn btn-info waves-effect pull-right" 
                            onclick="$('#exportModal').modal('show')">
                            <i class="material-icons">print</i>
                            <span>EXPORT</span>
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
                                <th class="text-center">Biometrics ID</th>
                                <th class="text-center">Employee</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Day</th>
                                <th class="text-center">Time In</th>
                                <th class="text-center">Break</th>
                                <th class="text-center">Resume</th>
                                <th class="text-center">Time Out</th>
                                <th class="text-center" style="min-width: 110px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $attendance) { ?>

                            <tr>
                                <td><?=$key+1?></td>
                                <td><?=$attendance->biometrics_id?></td>
                                <td><?=$attendance->employee_name?></td>
                                <td><?=$attendance->date?></td>
                                <td><?=$attendance->day?></td>
                                <td><?=$attendance->time_in?></td>
                                <td><?=$attendance->break?></td>
                                <td><?=$attendance->resume?></td>
                                <td><?=$attendance->time_out?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-circle waves-float edit-button" 
                                        onclick='editAttendance(<?=json_encode($attendance)?>)'
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Edit">
                                        <i class="material-icons">edit</i>
                                    </button>

                                    <button 
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-button"
                                        onclick="deleteAttendance('<?=$attendance->id?>')"
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
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">ADD ATTENDANCE</h4>
                            </div>
                            <form action="<?=base_url('Attendance/add/')?>">
                                <div class="form-horizontal modal-body">
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Employee</label>
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <select name="user_id" class="form-control show-tick" data-live-search="true">

                                                <?php foreach($employees as $employee) {?>

                                                    <option value="<?=$employee->id?>"><?=$employee->first_name.' '. $employee->middle_name.' '. $employee->last_name.' '.$employee->ext_name?></option>
                                                <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Date</label>
                                        <div class="col-md-12">
                                            <div class="form-line demo-masked-input">
                                                <input name="date" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Time In</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="time_in" type="text" class="form-control time" placeholder="HH:MM am">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Break</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="break" type="text" class="form-control time" placeholder="HH:MM pm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Resume</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="resume" type="text" class="form-control time" placeholder="HH:MM pm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Time Out</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="time_out" type="text" class="form-control time" placeholder="HH:MM pm">
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

                <div class="modal fade in" data-backdrop="static" id="editModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">EDIT ATTENDANCE</h4>
                            </div>
                            <form action="<?=base_url('Attendance/update/')?>">
                                <input type="hidden" name="id">
                                <div class="form-horizontal modal-body">
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Employee</label>
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <select name="user_id" class="form-control show-tick" data-live-search="true">

                                                <?php foreach($employees as $employee) {?>

                                                    <option value="<?=$employee->id?>"><?=$employee->first_name.' '. $employee->middle_name.' '. $employee->last_name.' '.$employee->ext_name?></option>
                                                <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Date</label>
                                        <div class="col-md-12">
                                            <div class="form-line demo-masked-input">
                                                <input name="date" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Time In</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="time_in" type="text" class="form-control time" placeholder="HH:MM am">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Break</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="break" type="text" class="form-control time" placeholder="HH:MM pm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Resume</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="resume" type="text" class="form-control time" placeholder="HH:MM pm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-md-12 m-b-10">Time Out</label>
                                        <div class="col-md-12">
                                            <div class="form-line time-masked-input">
                                                <input name="time_out" type="text" class="form-control time" placeholder="HH:MM pm">
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

                <div class="modal fade in" data-backdrop="static" id="uploadModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">UPLOAD EMPLOYEE ATTENDANCE</h4>
                            </div>
                            <form action="<?=base_url('attendance_excel/Upload_attendance/attendance')?>">
                                <div class="form-horizontal modal-body">
                                    <a target="_blank" class="btn btn-primary waves-effect" href="<?=base_url('attendance_excel/Export_attendance/attendance_template')?>">
                                        <i class="material-icons">file_download</i>
                                        <span>DOWNLOAD TEMPLATE</span>
                                    </a>

                                    <div class="form-group m-t-20">
                                        <label class="col-md-12">Select File</label>
                                        <div class="col-md-12">
                                            <div class="form-line" id="input-file-upload">
                                                <input type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#uploadModal').modal('hide')">CANCEL</button>
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

<div class="modal fade in" data-backdrop="static" id="exportModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EXPORT ATTENDANCE</h4>
            </div>
            
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-12">Period of Attendance</label>
                    <div class="col-sm-6">
                        <div class="input-group m-b-0">
                            <span class="input-group-addon">From</span>
                            <div class="form-line demo-masked-input">
                                <input name="from" type="text" class="form-control date-export" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group m-b-0">
                            <span class="input-group-addon">To</span>
                            <div class="form-line demo-masked-input">
                                <input name="to" type="text" class="form-control date-export" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editModal').modal('hide')">CANCEL</button>
                <button type="button" class="btn btn-success waves-effect" onclick="exportAttendance()">EXPORT</button>
            </div>
        </div>
    </div>
</div>

<script>
base_url = '<?=base_url()?>'
</script>