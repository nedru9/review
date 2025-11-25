<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Notifications\ServiceNotificationFactory;
use http\Client\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
            $token = trim($token);
            $validator = Validator::make(['token' => $token], [
                'token' => 'required|exists:lk_client,token',
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages(['Ошибка']);
            }

            /* @var Client $client */
            $client = Client::where('token', $token)->first();

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
