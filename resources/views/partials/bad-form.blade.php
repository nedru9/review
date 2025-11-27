@php
    use App\Models\Client;

/**
 * @var Client $client
 */
@endphp

<div class="w-full ">
    <form class="bg-white rating-star--border rounded px-4 pt-6 pb-8 mb-4" id="send-form" method="POST" data-token="{{ $client->token }}">
        @csrf
        <div class="mb-6">
            <p class="text-gray-700">Здесь можете оставить свой отзыв.</p>
        </div>
        <div class="mb-4">
            <input value="{{ old('fullName') }}" name="fullName"
                   class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="fullName" type="text" placeholder="Имя*">
            <span class="error-text text-red-500" data-error="fullName"></span>
        </div>
        <div class="mb-4">
            <input value="{{ old('phone') }}" name="phone"
                   class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="phone" type="text" placeholder="Номер телефона*">
            <span class="error-text text-red-500" data-error="phone"></span>
        </div>
        <div class="mb-4">
            <textarea
                class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="reviewText" id="reviewText" cols="30" rows="10" placeholder="Текст отзыва*">{{ old('reviewText') }}</textarea>
                <span class="error-text text-red-500" data-error="reviewText"></span>
        </div>
        <input type="hidden" name="token" value="{{$client->token}}">

        <div class="mb-3"><span class="error-text text-red-500" data-error="allError"></span></div>
        <div class="flex items-center justify-between">
            <button
                class="send-form bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Отправить
            </button>
            <button
                class="cancel-form bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button">
                Отменить
            </button>
        </div>
    </form>
</div>
