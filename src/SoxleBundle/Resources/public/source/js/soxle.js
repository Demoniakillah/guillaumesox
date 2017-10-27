$(function () {
    $(document).ready(function () {
        var uri = $('#soxle_js_params').attr('uri');
        var apiUrl = $('#soxle_js_params').attr('apiUrl');
        var imgBaseUrl = $('#soxle_js_params').attr('imgBaseUrl');
        $('p').css('display', 'inline-block');
        $('.image').addClass('image col-lg-6 col-md-12');
        $.ajax({
            url: apiUrl,
            data: {uri: uri},
            dataType: "json",
            method: "POST"
        })
                .done(function (data) {
                    var images = $('.image');
                    $.each(data, function (index, data) {
                        images[index].setAttribute('src', imgBaseUrl + '/' + data);
                    });
                });
    });
});