$(function () {
    $(document).ready(function () {
        var uri = $('#soxle_js_params').attr('uri');
        var apiUrl = $('#soxle_js_params').attr('apiUrl');
        var imgBaseUrl = $('#soxle_js_params').attr('imgBaseUrl');
        $('.soxle_p').css('display', 'inline-block');
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

        var positionFieldSelector = $('#soxle_js_params').attr('selector');
        unavailable(positionFieldSelector, $(positionFieldSelector).val());

        $(document).on('change', positionFieldSelector, function (event) {
            unavailable(this, event.target.valueAsNumber);
        });
        $(document).on('keyup', positionFieldSelector, function (event) {
            unavailable(this, event.target.valueAsNumber);
        });

        function unavailable(field, number) {
            var url = $('#soxle_js_params').attr('url');
            $.ajax({
                url: url,
                data: {position: number},
                method: "POST",
                field: field
            })
                    .done(function (data) {
                        console.log(data);
                        if (data === '1') {
                            disable(this.field);
                        } else {
                            enable(this.field);
                        }
                    });
        }

        function enable(field) {
            $(field).css('color', 'black');
        }

        function disable(field) {
            $(field).css('color', 'red');
        }

        $('body').append('<a href="#top" class="top_link" title="Revenir en haut de page">\n\
                            <span class="glyphicon glyphicon-arrow-up" style="font-size: 24px;"></span>\n\
                          </a>');
        $('.top_link').css({
            'position': 'fixed',
            'right': '20px',
            'bottom': '50px',
            'display': 'none',
            'padding': '20px',
            'background': '#fff',
            '-moz-border-radius': '40px',
            '-webkit-border-radius': '40px',
            'border-radius': '40px',
            'opacity': '0.9',
            'z-index': '2000'
        });
        $(window).scroll(function () {
            posScroll = $(document).scrollTop();
            if (posScroll >= 550)
                $('.top_link').fadeIn(600);
            else
                $('.top_link').fadeOut(600);
        });
    });
});