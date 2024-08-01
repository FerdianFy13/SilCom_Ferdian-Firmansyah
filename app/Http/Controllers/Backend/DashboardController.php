<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;

        $results = DB::select(DB::raw("
            SELECT
                (SELECT COUNT(*) FROM users WHERE id != :userId) AS user_count,
                (SELECT COUNT(*) FROM courses) AS course_count,
                (SELECT COUNT(*) FROM categories) AS category_count
        "), ['userId' => $userId]);

        $userData = 0;
        $courseData = 0;
        $categoryData = 0;

        if (!empty($results)) {
            $result = $results[0];
            $userData = $result->user_count ?? 0;
            $courseData = $result->course_count ?? 0;
            $categoryData = $result->category_count ?? 0;
        }

        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'menu' => 'Dashboard',
            'userData' => $userData,
            'courseData' => $courseData,
            'categoryData' => $categoryData
        ]);
    }
}
