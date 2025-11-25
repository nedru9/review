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
<h1>Welcome</h1>

@if(isset($client))
    <p>Your token is: {{ $client->token }}</p>
@else
    <p>No token provided.</p>
@endif
</body>
</html>
