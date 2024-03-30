<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College; // Assuming College is the model you want to search

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform the search query using Eloquent ORM or Query Builder
        $results = College::where('collegeName', 'like', "%$query%")
                          ->orWhere('collegeDean', 'like', "%$query%")
                          ->get();

        return view('search-results', ['results' => $results]);
    }
}
