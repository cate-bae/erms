$(function () {    
    $('.demo-masked-input').find('.date').inputmask('mm/dd/yyyy', { placeholder: '--/--/----' });
    $.AdminBSB.input.activate();

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

function editForm (info) {
    $('#editModal').find('input[name=id]').val(info.id);
    $('#editModal').find('input[name=from]').val(info.from);
    $('#editModal').find('input[name=to]').val(info.to);
    $('#editModal').find('input[name=position]').val(info.position);
    $('#editModal').find('input[name=department]').val(info.department);
    $('#editModal').find('input[name=salary]').val(info.salary);
    $('#editModal').find('input[name=salary_grade]').val(info.salary_grade);
    $('#editModal').find('input[name=status]').val(info.status);
    $('#editModal').find('input[name=govt][value='+info.govt+']').prop('checked', true);;
    $('#editModal').modal();
}

function deleteData (id) {
    swal({
        title: "Are you sure?",
        text: "Information will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'employee/Delete_employee/work_experience/' + $('#employee-id').val();
        let data = new FormData();
        data.append('id', id);
        ajaxPost(url, data)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}