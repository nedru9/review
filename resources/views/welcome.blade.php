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
    <title>Отзыв</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                <div class="rating-star mb-6">
                    <div class="rating-star-block">
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
                    <p class="rating-please">Пожалуйста, оставьте свой отзыв.</p>
                    <div class="rating-star-block">
                        <div class="rating-star-block-icon">
                            <span data-token="{{$client->token}}" class="bad"><i class="fa fa-star yellow rating-star-icon"></i></span>
                            <span data-token="{{$client->token}}" class="bad"><i class="fa fa-star yellow rating-star-icon"></i></span>
                            <span data-token="{{$client->token}}" class="bad"><i class="fa fa-star yellow rating-star-icon"></i></span>
                            <a href="{{$client->feedbackSettings->goodReviewSrc}}"><i
                                    class="fa fa-star yellow rating-star-icon"></i></a>
                            <a href="{{$client->feedbackSettings->goodReviewSrc}}"><i
                                    class="fa fa-star yellow rating-star-icon"></i></a>
                        </div>
                    </div>
                </div>

                <div class="bad-review w-full">

                </div>
            </div>
        </div>
    </div>
@endif
</body>
</html>
