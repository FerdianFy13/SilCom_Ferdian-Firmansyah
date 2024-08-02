<?php

namespace App\Http\Controllers\Front;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::with('category')->latest('created_at')->paginate(6);

        return view(
            'pages.course.index',
            [
                'title' => 'Course',
                'menu' => 'Course',
                'data' => $data
            ]
        );
    }
}
