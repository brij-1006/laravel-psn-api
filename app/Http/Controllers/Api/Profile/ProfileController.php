<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\Profile;
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
use Carbon\Carbon; ///  date/time
use Response;
use Storage;
use Config AS Config;


class ProfileController extends Controller
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
        //echo 'brij';  die;
        
        $profile = Profile::paginate(5);
        return  Response::json(array(
            'success' => true,   
            'data' =>$profile->toArray(),
        ),HttpResponse::HTTP_OK);
        
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Profile::create($request->all());
        return  Response::json(array(
            'success' => true,
            'message' =>'Profile created successfully',
        ),HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
       // return  $value = Config::get('app');  //die;

///echo Config::get('constants.ADMIN_NAME');  die;



         $profileCollection =  Profile::find($id);
          if (!$profileCollection) {
                $responseCollection = array('success' => false, 'message' => 'Could not create profile', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
            } else {
                $responseCollection = array('success' => true, 'message' => 'Profile data is updated', 'data' => $profileCollection);
                return Response::json($responseCollection, HttpResponse::HTTP_OK);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Update the specified resource in storage With Validation .
         * @return Current profile basic information 
         */
            $profileData = $request->all();
//            $rules = [
//                'first_name' => 'required',
//                'gender' => 'required',
//                'dob' => 'required|date',
//                'location'=> 'required',
//                'nationality' => 'required'
//            ];
//
//            $validator = Validator::make($profileData, $rules);
//
//            if ($validator->fails()) {
//                $validatorErrors = $validator->errors()->all();
//                return Response::json(
//                                array(
//                            'success' => false,
//                            'message' => $validatorErrors,
//                            'data' => null), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
//            }

            $profileCollection = Profile::find($id);
            
                
            
            if(isset($profileData['first_name'])){
               $profileCollection->first_name = $profileData['first_name']; 
            }
            if (isset($profileData['last_name'])) {
                $profileCollection->last_name = $profileData['last_name'];
            }
            if (isset($profileData['short_name'])) {
                $profileCollection->short_name = $profileData['short_name'];
            }
            if (isset($profileData['profile_type'])) {
                $profileCollection->profile_type = $profileData['profile_type'];
            }
            if (isset($profileData['premium_flag'])) {
                $profileCollection->premium_flag = $profileData['premium_flag'];
            }
            if (isset($profileData['relation_status_id'])) {
                $profileCollection->relation_status_id = $profileData['relation_status_id'];
            }
            if (isset($profileData['gender'])) {
                $profileCollection->gender = $profileData['gender'];
            }
            if (isset($profileData['industry_id'])) {
                $profileCollection->industry_id = $profileData['industry_id'];
            }
            if (isset($profileData['location'])) {
                $profileCollection->location = $profileData['location'];
            }
            if (isset($profileData['dob'])) {
                $profileCollection->dob = $profileData['dob'];
            }
            if (isset($profileData['nationality'])) {
                $profileCollection->nationality = $profileData['nationality'];
            }
            if (isset($profileData['country_ext'])) {
                $profileCollection->country_ext = $profileData['country_ext'];
            }
            if (isset($profileData['tag_line'])) {
                $profileCollection->tag_line = $profileData['tag_line'] ? $profileData['tag_line'] : $profileCollection->tag_line;
            }
            if (isset($profileData['about'])) {
                $profileCollection->about = $profileData['about'];
            }
            if (isset($profileData['expertise_on'])) {
                $profileCollection->expertise_on = $profileData['expertise_on'];
            }
            if (isset($profileData['work_summary'])) {
                $profileCollection->work_summary = $profileData['work_summary'];
            }
            if (isset($profileData['profession_id'])) {
                $profileCollection->profession_id = $profileData['profession_id'];
            }
            if (isset($profileData['phone'])) {
                $profileCollection->phone = $profileData['phone'];
            }
            if (isset($profileData['website'])) {
                $profileCollection->website = $profileData['website'];
            }
            if (isset($profileData['app_id'])) {
                $profileCollection->app_id = $profileData['app_id'];
            }
            if (isset($profileData['app_version'])) {
                $profileCollection->app_version = $profileData['app_version'];
            }
            $profileCollection->updated_at = Carbon::now();
            $profileCollection->active = 1;
            if (isset($profileData['avatar'])) {
                $profileCollection->avatar = $profileData['avatar'];
            }
            $profileCollection->save();
            if (!$profileCollection->_id) {
                $responseCollection = array('success' => false, 'message' => 'Could not create profile', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
            } else {
                $responseCollection = array('success' => true, 'message' => 'Profile data is updated', 'data' => $profileCollection);
                return Response::json($responseCollection, HttpResponse::HTTP_OK);
            }
        }

    protected static function saveVisibility($data) 
    {
        $visibilityCollection = Profile::find($id);
        $data->save(); 
         
    }
    
    
    public function avatar(Request $request)
    {
        /**
         * Update the specified resource in storage With Validation .
         * @return Current profile basic information 
         */
        
            $profileData = $request->all();
            $id = $profileData['_id']; /// die;
            $profileCollection = Profile::find($id);
            $avatarFile = 'avatar' . '_' . $id . '.' . 'jpg';
            $output_file = public_path();
            $output_file = $output_file . '/avatar/';
            $decodedImage = base64_decode($profileData['avatar']); // arrival
            $fileConfigArray['path'] = 'profile/';
            $fileConfigArray['name'] = 'avatar' . '_' . $id . '.' . 'jpg';
            $fileConfigArray['base64EncodeString'] = $profileData['avatar'];
            $uploadResponse =  parent::fileUploadBase64($fileConfigArray);
            $storage_path = storage_path(); 
            $avatarPath = $storage_path.'/app/profile/'.$fileConfigArray['name'];
            $avatarCollection = array();
            $avatarCollection['profile_id']  = $id;
            $avatarCollection['avatarPath']  = $avatarPath;
            $avatarCollection['avatar_updated_at']  = Carbon::now();
            $avatarCollection['avatar']  = $fileConfigArray['name'];
             
            if($uploadResponse == 1){
                 $profileCollection->avatar = $fileConfigArray['name'];
                 $profileCollection->avatar_updated_at =  $avatarCollection['avatar_updated_at'];
                 $profileCollection->user_client = parent::clientDetail($request);
                 $profileCollection->save();
                 $responseCollection = array('success' => true, 'message' => 'Profile photo is updated', 'data' => $avatarCollection);
                return Response::json($responseCollection, HttpResponse::HTTP_OK);
            }else{
                return Response::json(
                                array(
                            'success' => false,
                            'message' => 'Profile photo not uploaded',
                            'data' => null), HttpResponse::HTTP_BAD_REQUEST);
            }
           
    }

    /**
     * deactive profile the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $profileCollection = Profile::find($id);
            $profileCollection->active = 0;
            $profileCollection->save();
            if (!$profileCollection->_id) {
                $responseCollection = array('success' => false, 'message' => 'Could not deleted profile', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
            } else {
                $responseCollection = array('success' => true, 'message' => 'Profile is deleted', 'data' => $profileCollection);
                return Response::json($responseCollection, HttpResponse::HTTP_CREATED);
            }
    }
}
