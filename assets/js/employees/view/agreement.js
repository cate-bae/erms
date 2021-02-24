$(function () {
    $('.demo-masked-input').find('.date').inputmask('mm/dd/yyyy', { placeholder: '--/--/----' });
    $.AdminBSB.input.activate();
    $('form').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);
        swal({
            title: "Save changes?",
            // text: "Save changes",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Save",
            closeOnConfirm: false
        }, function () {
            showLoading();
            let url = base_url + 'employee/Update_employee/agreement/'+$('#employee-id').val();
            
            ajaxPost(url, data)
                .then(result => {
                    setTimeout(() => { location.reload() }, 1000);
                    showNotice(result.message, true) 
                })
                .catch(error => { showNotice(error.message, false) })
        });
    });
});

function enableFields (form) {
    $('#'+form).find('input').prop('disabled', false);
    $('#'+form).find('#edit-button').hide();
    $('#'+form).find('#cancel-button').show();
    $('#'+form).find('#save-button').show();
}