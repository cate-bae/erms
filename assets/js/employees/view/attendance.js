$(function () {
    $('.demo-masked-input').find('.date').inputmask('mm-dd-yyyy', { placeholder: '__/__/____' });
    $('form').submit(function (e) {
        e.preventDefault();

        let url = this.action + $('#employee-id').val();
        let data = new FormData(this);
        swal({
            title: "Save information?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Save",
            closeOnConfirm: false
        }, function () {
            
            showLoading();
            
            ajaxPost(url, data)
                .then(result => {
                    setTimeout(() => { location.reload() }, 1000);
                    $('.modal').modal('hide')
                    showNotice(result.message, true) 
                })
                .catch(error => { showNotice(error.message, false) })
        });
    });
});

function changeBiometricsId(id)
{
    $('#editModal').find('[name=biometrics_id]').val(id);
    $('#editModal').modal('show');
    $('#editModal').find('[name=biometrics_id]').focus();
}

function exportAttendance()
{
    let from = $('#exportModal').find('input[name="from"]').val();
    let to = $('#exportModal').find('input[name="to"]').val();
    let data = new FormData();
    data.append('from', from);
    data.append('to', to);
    ajaxPost(base_url + 'attendance_excel/Export_attendance/validate/', data)
        .then(result => {
            $('.modal').modal('hide')
            $('#exportModal').find('input[name="from"]').val('')
            $('#exportModal').find('input[name="to"]').val('')
            location.href = base_url + 'attendance_excel/Export_attendance/employee_attendance/'+ $('#employee-id').val() + '/' + from + '/' + to
        })
        .catch(error => { showNotice(error.message, false) })
}