
$(document).on("keypress", "[type='number']", function(event){
    return event.charCode >= 48 && event.charCode <= 57 || event.key === "Backspace";
});

function showLoading()
{
    swal({
        title: '<div class="preloader m-t-30">'+
            '<div class="spinner-layer pl-light-blue">'+
                '<div class="circle-clipper left">'+
                    '<div class="circle"></div>'+
                '</div>'+
                '<div class="circle-clipper right">'+
                    '<div class="circle"></div>'+
                '</div>'+
            '</div>'+
        '</div><h2>Loading...</h2>',
        // text: 'Please wait...',
        showConfirmButton: false,
        html: true                
    });
}

function closeLoading()
{
    swal({ title: '', timer: 0, showConfirmButton: false });
}

// status : true/false
function showNotice(msg, status)
{
    if(msg)
    {
        swal({
            title: msg,
            type: status ? 'success' : 'error',
            html: true
        });
    }
    else
    {
        errNotice();
    }
}

function errNotice()
{
    swal({
        title: 'Unable to process your request.',
        text: 'Please try again.',
        type: 'error',
        html: true
    });
}

function popupNotification()
{
    setTimeout(function () {
        var placementFrom = 'bottom';
        var placementAlign = 'center';
        var animateEnter = '';
        var animateExit ='';
        var colorName = 'alert-success';

        showNotification(colorName, placementFrom, placementAlign, animateEnter, animateExit, null);
    return false;
    }, 2000);
}


function showNotification(colorName, placementFrom, placementAlign, animateEnter, animateExit, text) {
    if (colorName === null || colorName === '') { colorName = 'bg-black'; }
    if (text === null || text === '') { text = 'Success'; }
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInUp'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutDown'; }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 1000,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
}

function ajaxPost(url, data)
{
    return new Promise((resolve, reject) => {
        // axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
        axios.post(url, data)
            .then(response => { validate_response(response, resolve, reject) })
            .catch(error => { checkError(error, reject) })
    })
}

function validate_response(response, resolve, reject)
{
    if (response.status !== 200 || 
        response.data.status === false ||
        !response.data.hasOwnProperty('status')){
        checkError(response, reject)
    }

    return resolve(response.data)
}

function checkError(error, reject)
{
    if (error && error.data)
    {
        return reject(error.data)
    }
    errNotice()
    return reject()
}

function showConfirmMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}

var resizeImage = function (settings) {
    var file = settings.file;
    var maxSize = settings.maxSize;
    var reader = new FileReader();
    var image = new Image();
    var canvas = document.createElement('canvas');
    var dataURItoBlob = function (dataURI) {
        var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
            atob(dataURI.split(',')[1]) :
            unescape(dataURI.split(',')[1]);
        var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var max = bytes.length;
        var ia = new Uint8Array(max);
        for (var i = 0; i < max; i++)
            ia[i] = bytes.charCodeAt(i);
        return new Blob([ia], { type: mime });
    };
    var resize = function () {
        var width = image.width;
        var height = image.height;
        if (width > height) {
            if (width > maxSize) {
                height *= maxSize / width;
                width = maxSize;
            }
        } else {
            if (height > maxSize) {
                width *= maxSize / height;
                height = maxSize;
            }
        }
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(image, 0, 0, width, height);
        var dataUrl = canvas.toDataURL('image/jpeg');
        return dataURItoBlob(dataUrl);
    };
    return new Promise(function (ok, no) {
        if (!file.type.match(/image.*/)) {
            no(new Error("Not an image"));
            return;
        }
        reader.onload = function (readerEvent) {
            image.onload = function () { return ok(resize()); };
            image.src = readerEvent.target.result;
        };
        reader.readAsDataURL(file);
    });
};