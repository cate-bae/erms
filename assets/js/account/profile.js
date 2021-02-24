
var $images = $('#profile-picture');
var $inputFile = $('#input-file-upload').find('input[name=file]');
var $inputFileLoader = $('#input-file-upload').find('.preloader');

$(function () {

    $('#update_profile').click(function(e) {
        $('#btn-update').hide();
        $('input').prop('disabled', false);
        $('.hide-view').removeClass('hide');
    });

    $('#btn-cancel').click(function(e) {
        $('input').prop('disabled', true)
        $('#btn-update').show();
        $('.hide-view').addClass('hide');
    });

    $('form').submit(function(e) {
        e.preventDefault();
        showLoading();
        
        let url = base_url + 'Account/update';
        let data = new FormData(this);

        $image = $images.find('img');
        if ($image.length > 0) {
            data.append('file', $image[0].src);
        }
        
        ajaxPost(url, data)
            .then(result => {
                
                $images.find('.img-profile').remove();
                if ($image.length > 0) {
                    $profilePicture = $('.profile-picture-view');
                    $profilePicture.attr('src', $image[0].src);
                    $('.profile-picture').attr('src', $image[0].src);
                }
                $('input[name=file]').val('');
                $('input').prop('disabled', true)
                $('#btn-update').show();
                $('.hide-view').addClass('hide');
                $('.picture-preview').addClass('hide');
                showNotice(result.message, true)
            })
            .catch(error => {
                showNotice(error.message, false)
            });
    });

})

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
                                style="width: 128px; height: 128px" 
                                src="` + readerEvent.target.result + `">
                        </div>`);
        };
        reader.readAsDataURL(file);

    } else {
        $images.find('.img-profile').remove();
        $('.picture-preview').addClass('hide');
    }
}
