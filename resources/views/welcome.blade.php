@php use App\Models\Client; @endphp
<?php
/**
 * @var Client $client
 */


?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
@if(isset($client))

    <img src="{{$client->feedbackSettings->imageSrc}}" alt="">

    <h1>{{$client->feedbackSettings->title}}</h1>
    <p>{{$client->feedbackSettings->description}}</p>

    <p>Оцените и оставьте отзыв</p>

    <div>
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="{{$client->feedbackSettings->goodReviewSrc}}">4</a>
        <a href="{{$client->feedbackSettings->goodReviewSrc}}">5</a>
    </div>

    <form method="POST" action="{{ route('form.sendReview') }}">
        @csrf
        <input type="text" name="fullName">
        <input type="email" name="email">
        <input type="text" name="telephone">
        <input type="hidden" name="token" value="{{$client->token}}">
        <textarea name="reviewText" cols="30" rows="10"></textarea>
        <button type="submit">Отправить</button>
    </form>
@else
    <p>No token provided.</p>
@endif
</body>
</html>
