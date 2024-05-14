<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class PredictionController extends Controller
{
    public function predictEmotion(Request $request)
    {
        $input_text = $request->input('input_text');

        try {
            $response = Http::post('http://1e97-34-73-48-234.ngrok-free.app/predict', [
                'input_text' => $input_text,
            ]);

            $predicted_emotion = (int) $response->body();  // Cast response body to integer

            return view('emotion', ['predicted_emotion' => $predicted_emotion]);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during prediction.']);
        }
    }
}
