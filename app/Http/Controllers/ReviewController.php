<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseJson;
use App\Http\Requests\FormReviewRequest;
use App\Http\Requests\TokenRequest;
use App\Models\Client;
use App\Models\Feedback;
use App\Notifications\ServiceNotificationFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

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
     * @param Client $client
     *
     * @return Factory|View|JsonResponse
     */
    public function sendReviewForm(FormReviewRequest $request, Client $client): Factory|View|JsonResponse
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $feedback = Feedback::create([
                'clientId' => $client->id,
                'reviewText' => $data['reviewText'] ?? null,
                'fullName' => $data['fullName'] ?? null,
                'phone' => $data['phone'] ?? null,
                'dateCreate' => now(),
            ]);

            foreach ($client->apps as $app) {
                $service = ServiceNotificationFactory::create($app, $feedback);
                $service->send();
            }

            DB::commit();

            return view('partials.success-send');
        } catch (Throwable $e) {
            DB::rollBack();

            return ResponseJson::ajaxError($e->getMessage());
        }
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
