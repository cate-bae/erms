$(function () {    
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

function editForm (form, info) {
    $('#edit'+form).find('input[name=id]').val(info.id);
    console.log(form)
    if (form == 'Skill') {
        console.log('sl;')
        $('#edit'+form).find('input[name=skill]').val(info.skill);
        $('#edit'+form).find('input[name=skill]').focus();
    } else {
        $('#edit'+form).find('input[name=name]').val(info.name);
        $('#edit'+form).find('input[name=name]').focus();
    }
    $('#edit'+form).modal();
}

function deleteData (form, id) {
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
        let url = base_url + 'employee/Delete_employee/'+form+'/' + $('#employee-id').val();
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