import './bootstrap';
import $ from 'jquery';
import Inputmask from "inputmask";

$(document).ready(function () {
    // Настройка CSRF для AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Маска телефона с делегированием
    const phoneMask = new Inputmask("+7 (999) 999-99-99");

    const applyMask = () => {
        document.querySelectorAll('input[name="phone"]').forEach(el => {
            if (!el.inputmask) phoneMask.mask(el);
        });
    };

    // Применяем при загрузке страницы
    applyMask();

    // Авто-применение для динамически добавленных полей
    const observer = new MutationObserver(applyMask);
    observer.observe(document.body, {childList: true, subtree: true});

    // Рейтинг звезд
    let selectedRating = 0;

    const updateStars = (container, rating) => {
        container.children().each((i, el) => {
            const star = $(el).find('.rating-star-icon');
            star.toggleClass('yellow', i < rating);
            star.toggleClass('gray', i >= rating);
        });
    };

    // Ховер по звёздам
    $('.rating-star-block-icon').on('mouseenter', 'span, a', function () {
        const index = $(this).index();
        updateStars($(this).parent(), index + 1);
    });

    $('.rating-star-block-icon').on('mouseleave', 'span, a', function () {
        updateStars($(this).parent(), selectedRating);
    });

    // Клик по звезде
    $('.rating-star-block-icon').on('click', 'span, a', function () {
        selectedRating = $(this).index() + 1;
        updateStars($(this).parent(), selectedRating);
    });

    // Плохой отзыв (показ формы)
    $('.rating-star-block-icon').on('click', 'span.bad', function () {
        const token = $(this).data('token');

        $.ajax({
            url: '/review/get-form',
            type: 'POST',
            data: {token},
            success: function (response) {
                $('.bad-review').html(response).show();
            },
            error: function (xhr) {
                console.error('Ошибка при загрузке формы:', xhr);
            }
        });
    });

    // Скрытие формы
    $('.bad-review').on('click', '.cancel-form', function () {
        $('.bad-review').hide();
        updateStars($('.rating-star-block-icon'), selectedRating);
    });

    // Отправка формы плохого отзыва
    $('.bad-review').on('submit', '#send-form', function (e) {
        e.preventDefault();

        const $form = $(this);
        const token = $form.data('token');

        $('.error-text').text(''); // очистка ошибок

        $.ajax({
            url: `/review/${token}/send-review`,
            type: 'POST',
            data: $form.serialize(),
            success: function (response) {
                $('.bad-review').html(response).show();
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, (field, messages) => {
                        $(`[data-error="${field}"]`).text(messages[0]);
                    });
                } else {
                    console.log(xhr);
                    $(`[data-error="allError"]`).text(xhr.responseJSON.message);
                }
            }
        });
    });

});
