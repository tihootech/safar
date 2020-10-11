
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

$(document).ready(function($) {


    $('.dropify').dropify(window.DROPIFY_OPTIONS);
    $('.select2').select2(window.SELECT2_OPTIONS);
    $('.counter').counterUp(window.COUNTER_OPTIONS);
});


// .cloner, .clone, data-target on cloner
$(document).on('click', '.cloner', function () {

    $('.select2 span').remove();
    var target = $(this).data('target');
    var container = $('#'+target);
    var item = container.find('.model');
    var cloned = item.clone();

    cloned.removeClass('model d-none').addClass('cloned');
    cloned.find('input, textarea').val(null);

    if (target == 'visas') {
        cloned.find('.card-header span').text($('#'+target+' > div').length + 1);
    }

    if (target == 'upload-images') {
        cloned.find('input[type=file]').dropify(window.DROPIFY_OPTIONS);
        cloned.find('label span').text($('#'+target+' > div').length);
    }


    container.append(cloned);
    $('select.select2').select2(window.SELECT2_OPTIONS);

});

$(document).on('click', '.remove-cloned', function () {

    $(this).parents('.cloned').remove();

});
