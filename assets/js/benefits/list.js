function addBenefit () {
    $('#addModal').modal('show');
}

function deleteBenefit (id) {
    swal({
        title: "Are you sure?",
        text: "Benefit will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Benefits/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function editBenefit (id, name) {
    $('#editModal').find('input[name=id]').val(id);
    $('#editModal').find('input[name=name]').val(name);
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
                $('#addModal').modal('hide');
                setTimeout(() => { location.reload() }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });
})
