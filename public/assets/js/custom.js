function redirect(path) {
    window.location.href = path;
}

function removeItem(array, item){
    for(var i in array){
        if(array[i]==item){
            array.splice(i,1);
            break;
        }
    }
    return array;
}


function swalError(message = 'خطایی رخ داد...') {
    swal('Oops...', message, 'error');
}

function swalWarning(message = 'خطایی رخ داد...') {
    swal('خطا!', message, 'warning');
}

function swalValidationErrors(errors) {
    var html = '<ul>';
    for (let error in errors) {
        if (errors.hasOwnProperty(error)) {
            html += '<li>'+errors[error]+'</li>'
        }
    }
    html += '</ul>';

    swal({
        title: 'اطلاعات وارد شده صحیح نیست',
        type: 'error',
        html: '<div class="alert alert-danger text-right mt-4">'+html+'</div>',
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'باشه.'
    });
}

function swalSuccess(message = 'تغییرات با موفقیت ذخیره شد', confirm=false) {
    if (confirm) {
        swal({
            position: 'center',
            icon: 'success',
            title: 'عالی!',
            html: message,
            type: 'success',
            showConfirmButton: true,
        });
    }else {
        swal({
            position: 'center',
            icon: 'success',
            title: message,
            type: 'success',
            showConfirmButton: false,
            timer: 1500
        });
    }
}

$(document).on('change', '.upload-hidden-image', function () {
    $(this).siblings('i').fadeIn();
});
