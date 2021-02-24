$(function () {    
    $('.demo-masked-input').find('.year').inputmask('y', { placeholder: '____' });
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

    $('input[type=radio]').on('change', function () {
        if (this.value == 'Yes') {
            $(this).parent('.demo-radio-button').siblings('.yes-details').show();
        } else {
            $(this).parent('.demo-radio-button').siblings('.yes-details').hide();
        }
    });
});

function editForm (info) {
    $('#editModal').find('input[name=id]').val(info.id);
    $('#editModal').find('input[name=name]').val(info.name);
    $('#editModal').find('input[name=address]').val(info.address);
    $('#editModal').find('input[name=telephone]').val(info.telephone);
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
        let url = base_url + 'employee/Delete_employee/reference/' + $('#employee-id').val();
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