function log () {
    showLoading();
    let url = base_url + 'Log/save_log';
    ajaxPost(url)
        .then(result => { 
            setTimeout(() => { location.reload() }, 1000);
            showNotice(result.message, true) 
        })
        .catch(error => { showNotice(error.message, false) })
}


$(function () {
    setInterval(() => {
        $('.current-time').text(getTime());
    }, 1000);
})

function getTime()
{
    let d = new Date();
    return d.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit', second: '2-digit'})
}