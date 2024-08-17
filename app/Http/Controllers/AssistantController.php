<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AssistantController extends Controller
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
}
