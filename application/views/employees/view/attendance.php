<div class="card">
    <div class="header">
        <h2>
            Attendance
            <?php if (in_array(get_user_type(), [-1, 0])) { ?>

            <!-- <a type="button" 
                class="btn btn-info waves-effect pull-right" 
                target="_blank"
                href="<?=base_url('attendance_excel/Export_attendance/employee_attendance/'.$user_id)?>">
                <i class="material-icons">print</i>
                <span>EXPORT</span>
            </a> -->
            <button type="button" 
                class="btn btn-info waves-effect pull-right" 
                onclick="$('#exportModal').modal('show')">
                <i class="material-icons">print</i>
                <span>EXPORT</span>
            </button>

            <button type="button" class="btn btn-primary waves-effect pull-right m-r-10" onclick="$('#uploadModal').modal('show')">
                <i class="material-icons">file_upload</i>
                <span>UPLOAD</span>
            </button>

            <button type="button" class="btn btn-warning waves-effect pull-right m-r-10" onclick="changeBiometricsId('<?=$biometrics_id?>')">
                <i class="material-icons">today</i>
                <span>EDIT BIOMETRICS ID</span>
            </button>

            <?php } ?>
            
        </h2>
        
        <div>Biometrics ID: <?=$biometrics_id?></div>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Day</th>
                        <th class="text-center">Time In</th>
                        <th class="text-center">Break</th>
                        <th class="text-center">Resume</th>
                        <th class="text-center">Time Out</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($info as $key => $attendance) { ?>

                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$attendance->date?></td>
                        <td><?=$attendance->day?></td>
                        <td><?=$attendance->time_in?></td>
                        <td><?=$attendance->break?></td>
                        <td><?=$attendance->resume?></td>
                        <td><?=$attendance->time_out?></td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>


<div class="modal fade in" data-backdrop="static" id="uploadModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">UPLOAD EMPLOYEE ATTENDANCE</h4>
            </div>
            <form action="<?=base_url('attendance_excel/Upload_attendance/employee_attendance/')?>">
                <div class="form-horizontal modal-body">
                    <a target="_blank" class="btn btn-primary waves-effect" href="<?=base_url('attendance_excel/Export_attendance/employee_template/'.$user_id)?>">
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


<div class="modal fade in" data-backdrop="static" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange p-t-15 p-b-15">
                <h4 class="modal-title" id="defaultModalLabel">EDIT BIOMETRICS ID</h4>
            </div>
            <form class="form-horizontal" action="<?=base_url('employee/Update_employee/biometrics/')?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Biometrics ID</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="biometrics_id" type="text" value="" class="form-control">
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