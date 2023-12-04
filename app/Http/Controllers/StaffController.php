<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HandlesTransaction;
use App\Services\StaffService;
use App\Http\Requests\StaffRequest;
use Illuminate\Support\Facades\Log;


class StaffController extends Controller
{
    use HandlesTransaction;
    protected $userService;

    public function __construct(StaffService $staff)
    {
        $this->staff = $staff;
    }

    public function index(Request $request){
        switch($request->type){
            case 'lists':
                return $this->staff->lists($request);
            break;
            case 'logs':
                return $this->staff->logs($request);
            break;
            default :
            return inertia('Modules/Staffs/Index');
        }
    }

    public function store(StaffRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            return $this->staff->saveStaff($request);
        });
        
        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function update(Request $request){
       
        switch($request->type){
            case 'verification':
                return $this->staff->verification($request);
            break;
            case 'token':
                return $this->staff->token($request);
            break;
            case 'revoke':
                return $this->staff->token($request);
            break;
            default: 
                $result = $this->handleTransaction(function () use ($request) {
                    return $this->staff->editStaff($request);
                });

                return back()->with([
                    'data' => $result['data'],
                    'message' => $result['message'],
                    'info' => $result['info'],
                    'status' => $result['status'],
                ]);
        }
    }
}
