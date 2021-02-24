function addAttendance () {
    $('#addModal').modal('show');
}

function deleteAttendance (id) {
    swal({
        title: "Are you sure?",
        text: "Attendance will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Attendance/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function editAttendance (info) {
    $('#editModal').find('input[name=id]').val(info.id);
    $('#editModal').find('select:not(.ms)').selectpicker('destroy');
    $('#editModal').find('select[name=user_id]').val(info.user_id);
    $('#editModal').find('select:not(.ms)').selectpicker('refresh');
    $('#editModal').find('input[name=date]').val(info.date);
    $('#editModal').find('input[name=time_in]').val(info.time_in);
    $('#editModal').find('input[name=break]').val(info.break);
    $('#editModal').find('input[name=resume]').val(info.resume);
    $('#editModal').find('input[name=time_out]').val(info.time_out);
    $('#editModal').modal();
    $('#editModal').find('input[name=date]').focus();
}

$(function () {
    $('.demo-masked-input').find('.date').inputmask('mm-dd-yyyy', { placeholder: '__/__/____' });
    $('.time-masked-input').find('.time').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    $('form').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = this.action;
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('#addModal').modal('hide');
                setTimeout(() => { location.reload() }, 1000);
            })
            .catch(error => { 
                showNotice(error.message, false) 
                $(input).parents('.form-line').addClass('error');
            })
    });
})


function exportAttendance()
{
    let from = $('#exportModal').find('input[name="from"]').val();
    let to = $('#exportModal').find('input[name="to"]').val();
    let data = new FormData();
    data.append('from', from);
    data.append('to', to);
    ajaxPost(base_url + 'attendance_excel/Export_attendance/validate', data)
        .then(result => {
            $('.modal').modal('hide')
            $('#exportModal').find('input[name="from"]').val('')
            $('#exportModal').find('input[name="to"]').val('')
            location.href = base_url + 'attendance_excel/Export_attendance/attendance/' + from + '/' + to
        })
        .catch(error => { showNotice(error.message, false) })
}
