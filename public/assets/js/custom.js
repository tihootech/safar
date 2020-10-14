window.DROPIFY_OPTIONS = {
    messages: {
        default: 'برای آپلود یا کلیک کنید، یا فایل مورد نظر را اینجا درگ کنید',
        replace: 'برای جایگزین کردن تصویر یا کلیک کنید، یا فایل مورد نظر را اینجا درگ کنید',
        remove:  'حذف',
        error:   'فایل آپلودی بیش از حد سنگین است'
    }
};

window.SELECT2_OPTIONS = {
    width : '100%'
};

window.COUNTER_OPTIONS = {
    delay: 100,
    time: 1200
};

function redirect(path) {
    window.location.href = path;
}


function swalError(message = 'خطایی رخ داد...') {
    swal('Oops...', message, 'error');
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

function swalSuccess(message = 'تغییرات با موفقیت ذخیره شد') {
    swal({
        position: 'center',
        icon: 'success',
        title: message,
        type: 'success',
        showConfirmButton: false,
        timer: 1500
    });
}

$(document).on('change', '.upload-hidden-image', function () {
    $(this).siblings('i').fadeIn();
});
