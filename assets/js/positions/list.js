function addPosition () {
    $('#add-position').find('.position_name').val('');
    $('#addModal').modal('show');
}

function deletePosition (id) {
    swal({
        title: "Are you sure?",
        text: "Position will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Positions/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function editPosition (id, name) {
    $('#position_id').val(id);
    $('#position_name').val(name);
    $('#editModal').modal('show');
}

$(function () {
    $('form#add-position').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = base_url + 'Positions/add';
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('#addModal').modal('hide');
                setTimeout(() => { location.reload() }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });
    $('form#edit-position').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = base_url + 'Positions/update';
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('#editModal').modal('hide');
                setTimeout(() => { location.reload() }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });
})