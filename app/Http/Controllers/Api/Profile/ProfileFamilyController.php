<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\Profile as Profile;
use App\Models\Profile\ProfileFamily;
/**
 * For profile attribute visibility
 */
use App\Models\Profile\ProfileVisibility;
use App\Models\Profile\ProfileVisibilityContact;
use App\Models\Profile\ProfileVisibilityCommunity;
/**
 * End Here
 */
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon; 
use Response;
use Storage;

class ProfileFamilyController extends Controller
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
    public function index(Request $request) {

        $profileFamilyData = $request->all();
        $profileId = $profileFamilyData['id'];
        $family = ProfileFamily::where('profile_id', '=', $profileId)->get();
        $familyIds = [];
        $familyMember = [];
        $profileFamilyCollection = [];
        $profileFamilyCollection['profile_id'] = $profileId;
        foreach ($family as $key => $value) {
            $familyIds[] = $value->family_profile_id;
            if(isset($value->family_name)){
                $familyNames[$key]['name'] = $value->family_name;
            }
            
            $profileFamilyCollection[$value->family_profile_id]['relation_id'] = $value->relation_id;
            $profileFamilyCollection[$value->family_profile_id]['family_profile_id'] = $value->family_profile_id;
            
           // $familyMember[$key]['relation_id'] = $value->relation_id;
           // $familyMember[$key]['profile_id'] = $value->family_profile_id;
        }
        
        $profileFamilies = Profile::whereIn('_id', $familyIds)->get();
        
        
        if (is_array($profileFamilyCollection)) {
            foreach ($profileFamilies as $key => $value) {
                ///$profileFamilyCollection[$profileId][$value->family_profile_id]
                 $profileFamilyCollection[$value->_id]['family_profile_id'] = $value->_id;
                 $profileFamilyCollection[$value->_id]['family_profile_avatar'] = $value->avatar;
                 $name = $value->first_name . ' ' . $value->last_name;
                 $profileFamilyCollection[$value->_id]['family_profile_name'] = isset($name)?$name:$value->short_name;
            }
        }  
        
//        else {
//            $profileFamilyCollection['family_profile_name'] = $familyMember;
//        }


        if (!isset($profileFamilyCollection)) {
            $responseCollection = array('success' => false, 'message' => 'Profile family member not exist!', 'data' => null);
            return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        } else {
            $responseCollection = array('success' => true, 'data' => $profileFamilyCollection);
            return Response::json($responseCollection, HttpResponse::HTTP_OK);
        }
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
        
       
        $profileFamilyData = $request->all();
        
        if (!$profileFamilyData['profile_id']) {
            $responseCollection = array('success' => false, 'message' => 'You are not autherized!', 'data' => null);
            return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        } else {

            $date = Carbon::now();
            $profileFamilyData['updated_at'] = $date->toDateTimeString();
            $profileFamilyData['created_at'] = $date->toDateTimeString();
            $row  = ProfileFamily::raw()->findOne(['profile_id' => $profileFamilyData['profile_id'], 'family_profile_id' => $profileFamilyData['family_profile_id']]);
            
            if(!$row){
                $responseProfileFamily = ProfileFamily::create($profileFamilyData);
                if ($responseProfileFamily) {
                    $profileFamilyData['_id'] = $responseProfileFamily->_id; 
                    return Response::json(array(
                                'success' => true,
                                'message' => 'Family member added succesfully',
                                'data' => $profileFamilyData
                                    ), HttpResponse::HTTP_OK);
                }else{
                    return Response::json(array('success' => false, 'message' => 'unauthorized user!','data' => null), HttpResponse::HTTP_BAD_REQUEST);
                }
            
            }  else {
                
               ProfileFamily::where('profile_id', $profileFamilyData['profile_id'])
                               ->where('family_profile_id', $profileFamilyData['family_profile_id'])
                               ->update(['relation_id' => $profileFamilyData['relation_id'],
                                         'family_name' => $profileFamilyData['family_name'],
                                         'updated_at'=>$profileFamilyData['updated_at']
                                   ]);
                  $updateCollection = ProfileFamily::raw()->findOne(['profile_id' => $profileFamilyData['profile_id'],'family_profile_id' => $profileFamilyData['family_profile_id']]);
                  $responseCollection = array('success' => true,'data' => $updateCollection);
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
