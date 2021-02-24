
$(function () {
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'MM/DD/YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('form').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = base_url + 'Account/add';
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => {
                // setTimeout(() => { 
                    location.href = base_url + 'Employees/create/' + result.data 
                // }, 1000);
                // showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
})