<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $course)
    {
        $this->course = $course;
    }

    public function index(Request $request){
        switch($request->type){
            case 'lists':
                return $this->course->lists($request);
            break;
            default :
            return inertia('Modules/Courses/Index');
        }
    }

    public function store(Request $request){
        switch($request->type){
            case 'preview':
                return $this->course->preview($request);
            break;
            case 'import':
                return $this->course->import($request);
            break;
        }
    }
}
