<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Qualifier\SaveService;
use App\Services\Qualifier\ViewService;

class QualifierController extends Controller
{
    protected $schoolService;

    public function __construct(SaveService $save, ViewService $view)
    {
        $this->save = $save;
        $this->view = $view;
    }

    public function index(Request $request){
        switch($request->type){
            case 'lists':
                return $this->view->lists($request);
            break;
            case 'statistics':
                return $this->statistics($request);
            break;
            case 'api':
                return $this->view->api($request);
            break;
            default :
            return inertia('Modules/Qualifiers/Index');
        }
    }
}
