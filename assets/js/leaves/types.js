function addType () {
    $('#addModal').modal('show');
}

function deleteType (id) {
    swal({
        title: "Are you sure?",
        text: "Leave type will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'leaves/Leave_types/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function editType (id, name, desc) {
    $('#editModal').find('input[name=id]').val(id);
    $('#editModal').find('input[name=name]').val(name);
    $('#editModal').find('[name=description]').val(desc);
    $('#editModal').modal('show');
}

$(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = this.action;
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('.modal').modal('hide');
                setTimeout(() => { location.reload() }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });
})
