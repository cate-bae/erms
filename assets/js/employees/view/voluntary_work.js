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
    $('#editModal').find('input[name=name]').val(info.name);
    $('#editModal').find('input[name=from]').val(info.from);
    $('#editModal').find('input[name=to]').val(info.to);
    $('#editModal').find('input[name=hours]').val(info.hours);
    $('#editModal').find('input[name=position]').val(info.position);
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
        let url = base_url + 'employee/Delete_employee/voluntary_work/' + $('#employee-id').val();
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