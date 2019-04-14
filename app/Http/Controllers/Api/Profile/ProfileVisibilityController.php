<?php

namespace App\Http\Controllers\Api\Profile;

/**
 * For profile attribute visibility
 */
use App\Models\Profile\ProfileVisibility;
use App\Models\Profile\ProfileVisibilityContact;
use App\Models\Profile\ProfileVisibilityCommunity;
/**
 * End Here
 */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Carbon\Carbon; 
use Response;
use Storage;


class ProfileVisibilityController extends Controller
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

         $profileVisibilityData = $request->all();

         echo '<pre>';
               print_r($profileVisibilityData);
         echo '<pre>';
         die;



        if($profileVisibilityData['attribute_id'] == '' &&  $profileVisibilityData['profile_id'] == ''){
            $responseCollection = array('success' => false, 'message' => 'Please provide '.$profileVisibilityData.' visibility', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }
        



       // $numRows = ProfileVisibility::where(['profile_id' => $profileVisibilityData['profile_id'],'attribute_id' => $profileVisibilityData['attribute_id']])->count();
        $rowCollection = ProfileVisibility::raw()->findOne(['profile_id' => $profileVisibilityData['profile_id'],'attribute_id' => $profileVisibilityData['attribute_id']]);
        
      ///  $getAttributeData = ProfileVisibility::find($profileVisibilityData['attribute_id']);



        if(!$profileVisibilityData['profile_id']){
            $responseCollection = array('success' => false, 'message' => 'Please provide profile id', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }else{
            $date = Carbon::now();
            $profileVisibilityData['created_at']  =  $date->toDateTimeString();
            $profileVisibilityData['updated_at']  =  $date->toDateTimeString();
            $numRows = ProfileVisibility::where(['profile_id' => $profileVisibilityData['profile_id'],'attribute_id' => $profileVisibilityData['attribute_id']])->count();
            if($numRows == 0){
                $responseProfileAllow = ProfileVisibility::create($profileVisibilityData);
                $newCollection = ProfileVisibility::find($responseProfileAllow->_id);
                $responseCollection = array('success' => true,'message' =>'Attribute visibility saved successfully','data' => $newCollection);
               return  Response::json($responseCollection,HttpResponse::HTTP_OK); 
            }  else {
              
               ProfileVisibility::where('profile_id', $profileVisibilityData['profile_id'])
                               ->where('attribute_id', $profileVisibilityData['attribute_id'])
                               ->update([
                                        'attribute_id' => $profileVisibilityData['attribute_id'],
                                        'updated_at'=>$profileVisibilityData['updated_at']
                                   ]);
                  $updateCollection = ProfileVisibility::raw()->findOne(['profile_id' => $profileVisibilityData['profile_id'],'attribute_id' => $profileVisibilityData['attribute_id']]);
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
