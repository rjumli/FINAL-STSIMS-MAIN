<?php

namespace App\Http\Controllers;

use App\Models\ListAgency;
use App\Models\ListDropdown;
use App\Models\ListPrivilege;
use App\Models\ListProgram;
use App\Models\ListStatus;
use App\Models\ListCourse;
use App\Models\SchoolCampus;
use App\Models\LocationRegion;
use App\Models\LocationProvince;
use App\Models\LocationMunicipality;
use App\Models\LocationBarangay;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ApiController extends Controller
{
    public function locations(Request $request,$type){
        if($type == 'count'){
            $array = [
                'Regions' => LocationRegion::count(),
                'Provinces' => LocationProvince::count(),
                'Municipalities' => LocationMunicipality::count(),
                'Barangays' => LocationBarangay::count()
            ];
            return $array;
        }else{
            switch($type){
                case 'regions' :
                    $data = LocationRegion::get();
                break;
                case 'provinces' :
                    $data = LocationProvince::get();
                break;
                case 'municipalities' :
                    $data = LocationMunicipality::get();
                break;
                case 'barangays' :
                    $data = LocationBarangay::get();
                break;
            }
            return $data;
        }
    }

    public function schools(Request $request,$type){
        $bearer = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearer);
        $region = $token->tokenable->profile->agency->region_code;

        if($type == 'count'){
            $in = SchoolCampus::where('region_code',$region)->count();
            $out = SchoolCampus::where('region_code','!=',$region)->count();
            $assigned = SchoolCampus::where('assigned_region',$region)->count();
            $array = [
                'Inside' => $in,
                'Outside' => $out,
                'Assigned' => $assigned,
                'Total' => $in + $out
            ];
            return $array;
        }else{
            $data = School::with('campuses','campuses.courses')->get();
            return $data;
        }
    }

    public function lists(Request $request,$type){
        if($type == 'count'){
            $array = [
                'Agencies' => ListAgency::count(),
                'Courses' => ListCourse::count(),
                'Programs' => ListProgram::count(),
                'Privileges' => ListPrivilege::count(),
                'Dropdowns' => ListDropdown::count(),
                'Statuses' => ListStatus::count()
            ];
            return $array;
        }
    }
}
