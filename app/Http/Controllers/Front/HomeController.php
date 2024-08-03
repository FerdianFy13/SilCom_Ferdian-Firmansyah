<?php

namespace App\Http\Controllers\Front;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = Course::with('category')->latest('created_at')->paginate(3);

        return view('pages.home.index', [
            'title' => 'Home',
            'data' => $data
        ]);
    }
}
