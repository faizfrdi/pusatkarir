<?php

namespace App\Http\Controllers;

use App\Models\Counselor;

class CounselingController extends Controller
{
    public function index($category)
    {
        if (!in_array($category, ['career', 'academic', 'mental'])) {
            abort(404);
        }

        $counselors = Counselor::where('category', $category)
            ->paginate(6);

        return view('counseling.category', compact('counselors', 'category'));
    }
}