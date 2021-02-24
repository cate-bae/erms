
var $images = $('#profile-picture');
var $inputFile = $('#input-file-upload').find('input[name=file]');
var $inputFileLoader = $('#input-file-upload').find('.preloader');

$(function () {

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
                }
                $('input[name=file]').val('');
                $('.picture-preview').addClass('hide');
                setTimeout(() => { location.href = base_url + 'account/alist' }, 1000);
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
