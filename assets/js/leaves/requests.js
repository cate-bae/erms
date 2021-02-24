function deleteRequest (id) {
    swal({
        title: "Are you sure?",
        text: "Leave request will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'leaves/Leave_requests/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function actionRequest (id, status) {
    $('#actionModal').find('input[name=id]').val(id);
    $('#actionModal').find('input[name=status]').val(status);
    let title = status == 1 ? 'APPROVE' : 'REJECT'
    $('#actionModal').find('.modal-title').text(title + ' LEAVE REQUEST');
    $('#actionModal').modal('show');
}

function viewRemarks (remarks) {
    $('#remarksModal').find('.remarks').text(remarks);
    $('#remarksModal').modal('show');
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
