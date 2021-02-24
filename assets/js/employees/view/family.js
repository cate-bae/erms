$(function () {
    $('.demo-masked-input').find('.date').inputmask('mm/dd/yyyy', { placeholder: '--/--/----' });
    $('.demo-masked-input').find('.year').inputmask('y', { placeholder: '----' });
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
    
    $('[name=citizenship]').on('change', function () {
        if (this.value == 'Dual Citizenship') {
            $('#dual_citizenship').show();
        } else {
            $('#dual_citizenship').hide();
        }
    });
});

function enableFields (form) {
    $('#'+form).find('input').prop('disabled', false);
    $('#'+form).find('select').prop('disabled', false);
    $('#'+form).find('.edit-button').hide();
    $('#'+form).find('.delete-button').hide();
    $('#'+form).find('.cancel-button').show();
    $('#'+form).find('.submit-button').show();
    $('#'+form).find('tr:first-child input').focus();
}

function editForm (id, name, birth_day) {
    $('#editModal').find('input[name=id]').val(id);
    $('#editModal').find('input[name=name]').val(name);
    $('#editModal').find('input[name=birth_day]').val(birth_day);
    $('#editModal').modal();
    $('#editModal').find('input[name=name]').focus();
}

function deleteChild (id) {
    swal({
        title: "Are you sure?",
        text: "Child's info will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'employee/Delete_employee/child/' + $('#employee-id').val();
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