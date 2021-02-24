
function deleteAccount(id) {
    swal({
        title: "Are you sure?",
        text: "Account will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Account/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                $('#account-'+id).remove();
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

