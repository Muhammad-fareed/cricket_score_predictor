<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Process\Process;

class PredictionController extends Controller
{

    public function showForm()
    {
        $teams = ['Australia', 'India', 'Bangladesh', /* Add other teams here */];
        $cities = ['Colombo', 'Mirpur', 'Johannesburg', /* Add other cities here */];

        return view('predict_cricket_score', compact('teams', 'cities'));
    }

    public function predictCricketScore(Request $request)
    {

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'batting_team' => 'required|string',
            'bowling_team' => 'required|string',
            'city' => 'required|string',
            'current_score' => 'required|numeric',
            'overs' => 'required|numeric',
            'wickets' => 'required|numeric',
            'last_five' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Prepare the input data
        $inputData = [
            'batting_team' => $request->input('batting_team'),
            'bowling_team' => $request->input('bowling_team'),
            'city' => $request->input('city'),
            'current_score' => $request->input('current_score'),
            'overs' => $request->input('overs'),
            'wickets_left' => $request->input('wickets'),
            'last_five' => $request->input('last_five'),
        ];

        // Convert the input data to JSON
        $inputJson = json_encode($inputData);

        // Use Python script to make predictions
        $process = new Process(['python', public_path('python_script.py'), $inputJson]);
        $process->run();

        // Check for errors
        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'Prediction failed: ' . $process->getErrorOutput()], 500);
        }

        // Get the predicted score from the Python script's output
        $predictedScore = intval($process->getOutput());

        // Return the predicted score as JSON
        // return response()->json(['predicted_score' => $predictedScore]);

        return view('predict_cricket_score_1', compact('predictedScore'));
    }
}
