$(function () {    
    $('.demo-masked-input').find('.year').inputmask('y', { placeholder: '----' });
    $.AdminBSB.input.activate();

    $('form').submit(function (e) {
        e.preventDefault();

        let url = this.action + $('#employee-id').val();
        let data = new FormData(this);
        swal({
            title: "Save education's information?",
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
    $('#editModal').find('select:not(.ms)').selectpicker('destroy');
    $('#editModal').find('select[name=level]').val(info.level);
    $('#editModal').find('select:not(.ms)').selectpicker('refresh');
    $('#editModal').find('input[name=school]').val(info.school);
    $('#editModal').find('input[name=course]').val(info.course);
    $('#editModal').find('input[name=from]').val(info.from);
    $('#editModal').find('input[name=to]').val(info.to);
    $('#editModal').find('input[name=units]').val(info.units);
    $('#editModal').find('input[name=year]').val(info.year);
    $('#editModal').find('input[name=honors]').val(info.honors);
    $('#editModal').modal();
    $('#editModal').find('input[name=level]').focus();
}

function deleteEducation (id) {
    swal({
        title: "Are you sure?",
        text: "Education will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'employee/Delete_employee/education/' + $('#employee-id').val();
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