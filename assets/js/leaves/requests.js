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
    $('#actionModal').modal('show');
}

function viewRemarks (id) {
    showLoading();
    
    let url = base_url + 'leaves/Leave_requests/info/' + id;
    
    ajaxPost(url)
        .then(result => { 
            
            $('#remarksModal').modal('show');
            const data = result.data.leave;

            $('#view_agency').text(data.agency);
            $('#view_name').text(result.data.employees[data.user_id].last_name + ' ' + result.data.employees[data.user_id].first_name + ' ' + result.data.employees[data.user_id].middle_name);
            $('#view_date_filing').text(data.date_filing);
            $('#view_position').text(result.data.employees[data.user_id].position_name);
            $('#view_salary').text(data.salary);

            $('#view_type').text(leave_types()[data.type]);
            if (parseInt(data.type) == 0) {
                $('.view_location').show();
                $('#view_type').text(leave_types()[data.type] + ': ' + data.type_vacation);
                if (data.type_vacation == 'Others (Specify)') {
                    $('#view_type').text(leave_types()[data.type] + ': ' + data.type_vacation_others);
                }
                $('#view_location').text(data.location);
                if (data.location == 'Abroad (Specify)') {
                    $('#view_location').text('Abroad: ' + data.location_abroad);
                }
            } else if (parseInt(data.type) == 1) {
                $('.view_location').show();
                if (parseInt(data.location_sick) == 1) {
                    $('#view_location').text('In hospital: ' + data.location_sick_hospital);
                }
            } else if (parseInt(data.type) == 3) {
                $('#view_type').text(leave_types()[data.type] + ': ' + data.type_others);
                $('.view_location').hide();
            } else {
                $('.view_location').hide();
            }
            $('#view_days').text(data.days);
            $('#view_inclusive_dates').text(data.date_from + ' - ' + data.date_to);
            $('#view_purpose').text(data.purpose);
            $('#view_commutation').text(data.commutation);

            $('#view_leave_credits_as_of').text(data.leave_credits_as_of);
            $('#view_vacation').text(data.vacation);
            $('#view_sick').text(data.sick);
            $('#view_cto').text(data.cto);
            $('#view_spl').text(data.spl);
            $('#view_solo_parent').text(data.solo_parent);


            $('#view_recommendation').text(data.recommendation);
            if (data.recommendation == 'Approval') {
                $('.approval').show();
                $('.disapproval').hide();
                $('#view_approval').text(data.days_with_pay + ' days with pay, ' + data.days_without_pay + ' days without pay');
            } else if (data.recommendation == 'Disapproval') {
                $('.disapproval').show();
                $('.approval').hide();
                $('#view_disapproval_reason').text(data.disapproval_reason);
                $('#view_disapproved_reason').text(data.disapproved_reason);
            } else {
                $('.approval').hide();
                $('.disapproval').hide();
            }

            if (data.recommendation != '' && result.data.employees) {
                $('#view_dept_head').html(get_name(result.data.employees[data.dept_head_id]) + '<br>' + result.data.employees[data.dept_head_id].position_name);
                $('#view_authorized_officer').html(get_name(result.data.employees[data.authorized_officer_id]) + '<br>' + result.data.employees[data.authorized_officer_id].position_name);
            } else {
                $('#view_dept_head').html('');
                $('#view_authorized_officer').html('');
            }
            
            closeLoading();
        })
        .catch(error => { showNotice(error.message, false) })
    
}

$(function () {
    $('.demo-masked-input').find('.date').inputmask('mm/dd/yyyy', { placeholder: '--/--/----' });
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

    $('[name="recommendation"]').change(function (e) {
        if (this.value == 'Approval') {
            $('.approval').show();
            $('.disapproval').hide();
        } else {
            $('.disapproval').show();
            $('.approval').hide();
        }
    })
})
