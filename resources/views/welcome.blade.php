@php
    use App\Models\Client;
    use App\Helpers\BaseHelper;

/**
 * @var Client $client
 */
@endphp

    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оставьте свой отзыв</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@if(isset($client))
    <div class="modal-review">
        <div class="container">
            <div class="review-img">
                <img src="{{$client->feedbackSettings->imageSrc}}" alt="">
            </div>

            <i class="fa-solid fa-xmark close"></i>
            <div class="rating">
                <p class="rating-title">{{$client->feedbackSettings->title}}</p>
                <p class="rating-description">{{$client->feedbackSettings->description}}</p>
                <div class="rating-star mb-6 rating-star--border">
                    <div class="rating-star-block flex justify-between flex-row">
                        <div class="rating-star-icon">
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                        </div>
                        <div>{{BaseHelper::countEvaluationsWord($client->feedbackSettings->countEvaluations)}}</div>
                    </div>
                </div>
                <div class="rating-star rating-star--border mb-6">
                    <p class="rating-please">Пожалуйста, оцените по 5-бальной шкале.</p>
                    <div class="rating-star-block flex justify-center flex-row">
                        <div class="rating-star-block-icon">
                            <span data-token="{{$client->token}}" class="bad"><i
                                    class="big-size fa fa-star yellow rating-star-icon"></i></span>
                            <span data-token="{{$client->token}}" class="bad"><i
                                    class="big-size fa fa-star yellow rating-star-icon"></i></span>
                            <span data-token="{{$client->token}}" class="bad"><i
                                    class="big-size fa fa-star yellow rating-star-icon"></i></span>
                            <a href="{{$client->feedbackSettings->goodReviewSrc}}"><i
                                    class="fa fa-star yellow rating-star-icon big-size"></i></a>
                            <a href="{{$client->feedbackSettings->goodReviewSrc}}"><i
                                    class="fa fa-star yellow rating-star-icon big-size"></i></a>
                        </div>
                    </div>
                </div>

                <div class="bad-review w-full">

                </div>
            </div>
        </div>
    </div>
@endif

<footer>
    <div class="main-footer-block">
        <a target="_blank" href="https://buzaa.ru/">Разработано в Buzaa.ru</a>
    </div>
</footer>
</body>
</html>
