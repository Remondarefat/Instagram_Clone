<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Adjust this according to your model

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('username', 'like', "%$query%")->get();

        return response()->json($results);
    }
}
