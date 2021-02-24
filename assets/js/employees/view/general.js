$(function () {    
    $('.demo-masked-input').find('.date').inputmask('mm/dd/yyyy', { placeholder: '--/--/----' });
    $.AdminBSB.input.activate();

    $('form').submit(function (e) {
        e.preventDefault();

        let url = this.action + $('#employee-id').val();
        let data = new FormData(this);
        if (url.includes('save_picture')) {
            $image = $images.find('img');
            if ($image.length > 0) {
                data.append('file', $image[0].src);
            }
        }
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
                    $('.modal').modal('hide')
                    setTimeout(() => { location.reload() }, 1000);
                    showNotice(result.message, true) 
                })
                .catch(error => { showNotice(error.message, false) })
        });
    });

    $('[name=job_status]').on('change', function () {
        if (this.value == 1) {
            $('.regular-employee').show();
        } else {
            $('.regular-employee').hide();
        }
    });
});


var $images = $('#profile-picture');
var $inputFile = $('#input-file-upload').find('input[name=file]');
var $inputFileLoader = $('#input-file-upload').find('.preloader');
function showImage (input) {
    if (input.files && input.files[0]) {
        $inputFileLoader.removeClass('hide');

        let file = input.files[0];

        var reader = new FileReader();
        reader.onload = function (readerEvent) {
            $inputFileLoader.addClass('hide');
            $('.picture-preview').removeClass('hide');
            $images.html(`<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 img-profile">
                            <img 
                                class="thumbnail" 
                                style="max-width: 100%; max-height: 200px; object-fit: contain" 
                                src="` + readerEvent.target.result + `">
                        </div>`);
        };
        reader.readAsDataURL(file);
    } else {
        $images.find('.img-profile').remove();
        $('.picture-preview').addClass('hide');
    }
}

function changeProfilePicture() {
    $('#changeImage').find('input').val('');
    $images.find('.img-profile').remove();
    $('.picture-preview').addClass('hide');
    $('#changeImage').modal('show')
}

function disableAccount (disable) {
    let action = disable == 0 ? "enabled" : "disabled"
    swal({
        title: "Are you sure?",
        text: "Account will be " + action,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continue",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'employee/Update_employee/account_disable/' + $('#employee-id').val();
        let data = new FormData();
        data.append('disabled', disable);
        ajaxPost(url, data)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}