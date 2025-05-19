<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Валідація параметрів
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'city' => 'required|string',
            'frequency' => 'required|in:daily,hourly',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Перевірка: чи вже існує підписка з таким email + city
        $exists = Subscription::where('email', $request->email)
                              ->where('city', $request->city)
                              ->exists();

        if ($exists) {
            return response()->json(['message' => 'Email already subscribed'], 409);
        }

        // Створення підписки
        Subscription::create([
            'email' => $request->email,
            'city' => $request->city,
            'frequency' => $request->frequency,
            'confirmed' => false,
            'confirmation_token' => Str::uuid(),
            'unsubscribe_token' => Str::uuid(),
        ]);

        return response()->json(['message' => 'Subscription successful. Confirmation email sent.'], 200);
    }


public function confirm($token)
{
    $subscription = Subscription::where('confirmation_token', $token)->first();

    if (!$subscription) {
        return response()->json(['message' => 'Token not found'], 404);
    }

    if ($subscription->confirmed) {
        return response()->json(['message' => 'Subscription already confirmed'], 400);
    }

    $subscription->confirmed = true;
    $subscription->save();

    return response()->json(['message' => 'Subscription confirmed successfully'], 200);
}

public function unsubscribe($token)
{
    $subscription = Subscription::where('unsubscribe_token', $token)->first();

    if (!$subscription) {
        return response()->json(['message' => 'Token not found'], 404);
    }

    // Якщо хочеш видалити:
    $subscription->delete();

    // Якщо хочеш лише деактивувати:
    // $subscription->confirmed = false;
    // $subscription->save();

    return response()->json(['message' => 'Unsubscribed successfully'], 200);
}

}
