<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Notifications\ServiceNotificationFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    /**
     * @param $token
     *
     * @return Factory|View
     */
    public function show($token): Factory|View
    {
        try {
            $token = trim($token);
            $validator = Validator::make(['token' => $token], [
                'token' => 'required|exists:lk_client,token',
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages(['Ошибка']);
            }

            $client = Client::where('token', $token)->first();

            return view('welcome', ['client' => $client]);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }

    /**
     * @param $token
     *
     * @return Factory|View
     */
    public function sendReview(Request $request): Factory|View
    {
        try {
            $fullName = $request->input('fullName');
            $email = $request->input('email');
            $telephone = $request->input('telephone');
            $token = $request->input('token');
            $reviewText = $request->input('reviewText');

            /* @var Client $client */
            $client = Client::where('token', $token)->first();


            // тут сохранение отзыва в БД



            foreach ($client->apps as $app) {
                $service = ServiceNotificationFactory::create($app);
                $service->send();
            }

            return view('welcome', ['client' => $client]);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }
}
