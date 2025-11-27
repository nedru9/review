<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormReviewRequest;
use App\Http\Requests\TokenRequest;
use App\Models\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReviewController extends Controller
{
    /**
     * Отображение страницы
     *
     * @param Client $client
     *
     * @return Factory|View
     */
    public function show(Client $client): Factory|View
    {
        return view('welcome', ['client' => $client]);
    }

    /**
     * Отправка отзыва
     *
     * @param FormReviewRequest $request
     *
     * @return Factory|View
     */
    public function sendReviewForm(FormReviewRequest $request): Factory|View
    {
        $data = $request->validated();

//            /* @var Client $client */
//            $client = Client::where('token', $token)->first();
//
//
//            // тут сохранение отзыва в БД
//
//
//            foreach ($client->apps as $app) {
//                $service = ServiceNotificationFactory::create($app);
//                $service->send();
//            }

        return view('partials.success-send');
    }

    /**
     * Отображение формы для плохого отзыва
     *
     * @param TokenRequest $request
     *
     * @return Factory|View
     */
    public function getReviewForm(TokenRequest $request): Factory|View
    {
        $client = Client::where('token', $request->validated('token'))->firstOrFail();

        return view('partials.bad-form', ['client' => $client]);
    }
}
