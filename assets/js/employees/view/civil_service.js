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
            $('.modal').modal('hide')
            
            showLoading();
            
            ajaxPost(url, data)
                .then(result => {
                    setTimeout(() => { location.reload() }, 1000);
                    showNotice(result.message, true) 
                })
                .catch(error => { showNotice(error.message, false) })
        });
    });
});

function editForm (info) {
    $('#editModal').find('input[name=id]').val(info.id);
    $('#editModal').find('input[name=title]').val(info.title);
    $('#editModal').find('input[name=rating]').val(info.rating);
    $('#editModal').find('input[name=date]').val(info.date);
    $('#editModal').find('input[name=place]').val(info.place);
    $('#editModal').find('input[name=license]').val(info.license);
    $('#editModal').find('input[name=validity]').val(info.validity);
    $('#editModal').modal();
    $('#editModal').find('input[name=title]').focus();
}

function deleteService (id) {
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
        let url = base_url + 'employee/Delete_employee/civil_service/' + $('#employee-id').val();
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