<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\ProfilePlace;
/**
 * For profile attribute visibility
 */
use App\Models\Profile\ProfileVisibility;
use App\Models\Profile\ProfileVisibilityContact;
use App\Models\Profile\ProfileVisibilityCommunity;
/**
 * End Here
 */
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon; 
use Response;
use Storage;

class ProfilePlaceController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profilePlaceData = $request->all();
        
        if($profilePlaceData['location'] == ''){
            $responseCollection = array('success' => false, 'message' => 'Please provide place location', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }
        
        if(!$profilePlaceData['profile_id']){
            $responseCollection = array('success' => false, 'message' => 'Please provide profile id', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }else{
            $date = Carbon::now();
            $profilePlaceData['created_at']  =  $date->toDateTimeString();
            $profilePlaceData['updated_at']  =  $date->toDateTimeString();
            $profilePlaceData['active']  =  1;
            $numRows = ProfilePlace::where(['profile_id' => $profilePlaceData['profile_id'],'location' => $profilePlaceData['location']])->count();
            if($numRows == 0){
                $responseProfilePlace = ProfilePlace::create($profilePlaceData);
                $newCollection = ProfilePlace::find($responseProfilePlace->_id);
                $responseCollection = array('success' => true,'message' =>'Place location saved successfully','data' => $newCollection);
               return  Response::json($responseCollection,HttpResponse::HTTP_OK); 
            }  else {
               $updateCollection = ProfilePlace::raw()->findOne(['profile_id' => $profilePlaceData['profile_id'],'location' => $profilePlaceData['location']]);
               $updateCollection['updated_at']  =  $date->toDateTimeString();
               ProfilePlace::where('profile_id', $profilePlaceData['profile_id'])
                               ->where('location', $profilePlaceData['location'])
                               ->update([
                                        'location_type' => $profilePlaceData['location_type'],
                                        'location' => $profilePlaceData['location'],
                                        'updated_at'=>$updateCollection['updated_at']
                                   ]);
                
                 $responseCollection = array('success' => true,'message' =>'Place location update successfully','data' => $updateCollection);
                return  Response::json($responseCollection,HttpResponse::HTTP_OK); 
            }
            
            
           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
