<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
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
}
