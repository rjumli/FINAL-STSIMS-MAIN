<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Scholar\SaveService;
use App\Services\Scholar\ViewService;

class ScholarController extends Controller
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
            return inertia('Modules/Scholars/Index');
        }
    }

    public function store(Request $request){
        switch($request->type){
            case 'preview':
                return $this->save->preview($request);
            break;
            case 'import':
                return $this->save->import($request);
            break;
            case 'truncate':
                return $this->truncate($request);
            break;
            case 'sync':
                return $this->save->sync($request);
            break;
            case 'bank':
                return $this->bank($request);
            break;
            case 'bank-update':
                return $this->bank_update($request);
            break;
        }
    }
}
