<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AssessmentController extends Controller
{
    public array $dictionary;

    public function __construct()
    {
        $this->dictionary = Config::get('assistants-configs.depression');
    }

    public function assessQuery(Request $request)
    {
        return $this->isDepressionRelated($request->search, $this->dictionary);
    }

    // Function to check if the search term matches any entry in the dictionary
    private function isDepressionRelated(String $searchTerm, $dictionary)
    {
        // Normalize the search term
        $searchTerm = strtolower(trim($searchTerm));

        $patterns = [];
        foreach ($dictionary as $dictValue) {
            foreach($dictValue as $pattern)
            {
                if (str_contains($pattern, $searchTerm)) {
                    array_push($patterns,$pattern);
                }
            }
        }

        return $patterns;
    }

    public function fetchCommonSymptoms(Request $request)
    {
        $id = (int)$request->id;

        $question = Question::where('type', $request->type)
        ->when(($id > 0), function($q){
            $q->where('id', request()->id);
        })
        ->first();
        $ids = Question::where('type', $request->type)->pluck('id');


        // Store answers if any
        if($request->answer == "YES" || $request->answer == "NO")
        {
            Answer::updateOrCreate(
                ['session_id' => $request->session_id, 'question_id' => $request->question_id],
                ['answer' => $request->answer]
            );
        }

        return response()->json([
            'question' => $question,
            'ids' => $ids,
            'count' => $ids->count()
        ]);
    }

    public function fetchStreamlineSymptoms(Request $request)
    {
        $id = (int)$request->id;

        $question = Question::where('type', '!=', 'common')
        ->when(($id > 0), function($q){
            $q->where('id', request()->id);
        })
        ->first();
        $ids = Question::where('type', '!=', 'common')->pluck('id');


        // Store answers if any
        if($request->answer == "YES" || $request->answer == "NO")
        {
            Answer::updateOrCreate(
                ['session_id' => $request->session_id, 'question_id' => $request->question_id],
                ['answer' => $request->answer]
            );
        }

        return response()->json([
            'question' => $question,
            'ids' => $ids,
            'count' => $ids->count()
        ]);
    }
}
