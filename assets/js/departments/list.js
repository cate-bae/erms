function addDepartment () {
    $('#add-department').find('.department_name').val('');
    $('#addModal').modal('show');
}

function deleteDepartment (id) {
    swal({
        title: "Are you sure?",
        text: "Department will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Departments/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function editDepartment (id, name) {
    $('#department_id').val(id);
    $('#department_name').val(name);
    $('#editModal').modal('show');
}

$(function () {
    $('form#add-department').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = base_url + 'Departments/add';
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('#addModal').modal('hide');
                setTimeout(() => { location.reload() }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });
    $('form#edit-department').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = base_url + 'Departments/update';
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

function showImage (input) {
    if (input.files && input.files[0]) {
        $inputFileLoader.removeClass('hide');

        let file = input.files[0];

        var reader = new FileReader();
        reader.onload = function (readerEvent) {
            $inputFileLoader.addClass('hide');
            $('.picture-preview').removeClass('hide');
            $images.html(`<img 
                                class="thumbnail m-b-0" style="max-width: 100%"
                                src="` + readerEvent.target.result + `">`);
        };
        reader.readAsDataURL(file);

    } else {
        $images.find('.img-profile').remove();
        $('.picture-preview').addClass('hide');
    }
}