<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Group;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer; // Use an available tokenizer
use Phpml\Classification\KNearestNeighbors;
use Phpml\FeatureExtraction\StopWords;


class AssessmentController extends Controller
{
    public array $dictionary;

    public function __construct()
    {
        $this->dictionary = Config::get('assistants-configs.depression');
    }

    public function assessQuery(Request $request)
    {
        $query = $request->search ?? "kill myself";

        // Escape the query to prevent injection attacks
        $escaped_query = escapeshellarg($query);

        // Command to run the Python script
        $basePath = base_path();
        $scriptPath = $basePath . '/scripts/text_classifier.py';
        $command = "python3 " . $scriptPath . " " . $escaped_query;

        // Execute the command and capture the output
        $output = shell_exec($command);

        // Decode the JSON output from the Python script
        return $ml_category = json_decode($output, true);
        // return $this->isDepressionRelated($request->search, $this->dictionary, $ml_category);
    }

    // Function to check if the search term matches any entry in the dictionary
    // private function isDepressionRelated(String $searchTerm, $dictionary, $ml_category)
    // {
    //     // Normalize the search term
    //     $searchTerm = strtolower(trim($searchTerm));

    //     $patterns = [];
    //     foreach ($dictionary as $dictValue) {
    //         foreach($dictValue as $pattern)
    //         {
    //             if (str_contains($pattern, $searchTerm)) {
    //                 array_push($patterns,$pattern);
    //             }
    //         }
    //     }

    //     return [$patterns];
    // }

    public function fetchCommonSymptoms(Request $request)
    {
        $id = (int)$request->id;
        // return $request->all();
        if(strlen($request->session_id) > 0)
        {
            User::updateOrCreate(
                ['session_id' => $request->session_id],
                ['name' => $request->name, 'gender' => $request->gender, 'dob' => $request->dob]
            );
        }

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

    public function fetchResultSymptoms()
    {
        $data = Group::with(['questions.answers' => function($query) {
            $query->where('session_id', request()->session_id);
        }])
        ->where('group', '!=', '-')
        ->get();

        $user = User::where('session_id', request()->session_id)->first();
        return $this->getCounts($data, $user);
    }

    private function getCounts($data, $user) {
        $results = [];

        foreach ($data as $group) {
            $groupName = $group['group'];
            $groupDescription = $group['description'] ?? '';
            $groupSolution = $group['solution'] ?? '';
            $groupLink = $group['link'] ?? '';
            $totalQuestions = 0;
            $yesCount = 0;

            foreach ($group['questions'] as $question) {
                $totalQuestions++;

                foreach ($question['answers'] as $answer) {
                    if ($answer['answer'] === "YES") {
                        $yesCount++;
                    }
                }
            }

            if($yesCount > 0 && $totalQuestions > 0)
            {
                if(($yesCount/$totalQuestions) >= 0.71)
                {
                    $results[] = [
                        'user' => $user,
                        'group' => $groupName,
                        'description' => $groupDescription,
                        'solution' => $groupSolution,
                        'link' => $groupLink,
                        'total_questions' => $totalQuestions,
                        'yes_count' => $yesCount,
                        'name' => $user->name,
                        'gender' => $user->gender,
                        'dob' => $user->dob,
                    ];
                }
            }

        }

        return $results;
    }
}
