import './bootstrap';
import $ from 'jquery';
import Inputmask from "inputmask";

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const mask = new Inputmask("+7 (999) 999-99-99");

    const applyMask = () => {
        document.querySelectorAll('input[name="phone"]').forEach(el => {
            if (!el.inputmask) mask.mask(el);
        });
    };

    // При загрузке
    applyMask();

    // При любых изменениях DOM (динамические поля)
    const observer = new MutationObserver(applyMask);
    observer.observe(document.body, { childList: true, subtree: true });

    let selectedRating = 0;

    $('.rating-star-block-icon span, .rating-star-block-icon a').hover(
        function() {
            const index = $(this).index();
            $(this).parent().children().each(function(i) {
                if (i <= index) {
                    $(this).find('.rating-star-icon').removeClass('gray').addClass('yellow');
                } else {
                    $(this).find('.rating-star-icon').removeClass('yellow').addClass('gray');
                }
            });
        },
        function() {
            $(this).parent().children().each(function(i) {
                if (i < selectedRating) {
                    $(this).find('.rating-star-icon').removeClass('gray').addClass('yellow');
                } else {
                    $(this).find('.rating-star-icon').removeClass('yellow').addClass('gray');
                }
            });
        }
    );

    $('.rating-star-block-icon span, .rating-star-block-icon a').click(function() {
        selectedRating = $(this).index() + 1;
        $('.rating-star-block-icon .rating-star-icon').removeClass('gray');
        $('.rating-star-block-icon .rating-star-icon').each(function(i) {
            if (i < selectedRating) {
                $(this).removeClass('gray').addClass('yellow');
            } else {
                $(this).removeClass('yellow').addClass('gray');
            }
        });
    });

    $('.rating-star-block-icon span').click(function() {
        if ($(this).hasClass('bad')) {
            let token = $(this).data('token');

            $.ajax({
                url: '/review/get-form',
                type: 'POST',
                data: {
                    token: token
                },
                success: function(response) {
                    $('.bad-review').html(response).show();
                },
                error: function(xhr) {
                    console.error('Ошибка при загрузке формы:', xhr);
                }
            });
        } else {
            $('.bad-review').hide();
        }
    });

    $('.bad-review').on('click', '.cancel-form', function() {
        $('.bad-review').hide();
        $('.rating-star-icon').removeClass('gray').addClass('yellow');
    });

    $('.bad-review').on('submit', '#send-form', function(e) {
        e.preventDefault();

        $('.error-text').text(''); // Очистка ошибок

        $.ajax({
            url: '/review/send-form',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('.bad-review').html(response).show();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(field, messages) {
                        $('[data-error="'+field+'"]').text(messages[0]);
                    });
                }
            }
        });
    });

});
