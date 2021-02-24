
$(function () {
    $('#sign_in').submit(function(e) {
        e.preventDefault();

        showLoading();
            
        let url = base_url + 'Login/sign_in';
        let data = $(this).serialize();
        ajaxPost(url, data)
            .then(result => { 
                if (result.data.has_profile_data) {
                    window.location = base_url + 'Log'; 
                } else {
                    window.location = base_url + 'Employees/create'; 
                }
            })
            .catch(error => { showNotice(error.message, false) })
    });
})