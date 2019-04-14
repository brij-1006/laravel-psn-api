<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\Profile as Profile;
use App\Models\Profile\ProfileFollower;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon; ///  date/time
use Response;
use Storage;

class ProfileFollowerController extends Controller
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

        $profileFollowerData = $request->all();
        $profileId = $profileFollowerData['id'];
        $follower = ProfileFollower::where('profile_id', '=', $profileId)->get();
        $followerIds = [];
        foreach ($follower as $key => $value) {
            $followerIds[] = $value->follower_id;
        }
        
        $profileFollowers = Profile::whereIn('_id', $followerIds)->get();
        $profileFollowerCollection = array();
        foreach ($profileFollowers as $key => $value) {
            $profileFollowerCollection[$key]['profile_follower_id'] = $value->_id;
            $profileFollowerCollection[$key]['profile_follower_avatar'] = $value->avatar;
            $profileFollowerCollection[$key]['profile_follower_name'] = $value->first_name.' '.$value->last_name;
        }

        if (!isset($profileFollowerCollection)) {
            $responseCollection = array('success' => false, 'message' => 'Profile followers not exist!', 'data' => null);
            return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        } else {
            $responseCollection = array('success' => true, 'data' => $profileFollowerCollection);
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
        
        $profileFollowerData = $request->all();
        if (!$profileFollowerData['profile_id']) {
            $responseCollection = array('success' => false, 'message' => 'You are not autherized!', 'data' => null);
            return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        } else {

            $date = Carbon::now();
            $profileFollowerData['updated_at'] = $date->toDateTimeString();
            $profileFollowerData['created_at'] = $date->toDateTimeString();
            $row  = ProfileFollower::raw()->findOne(['profile_id' => $profileFollowerData['profile_id'], 'follower_id' => $profileFollowerData['follower_id']]);
            if(!$row){
                $responseProfileFollower = ProfileFollower::create($profileFollowerData);
                if ($responseProfileFollower) {
                    // $followerData  = ProfileFollower::raw()->findOne(['profile_id' => $profileFollowerData['profile_id'], 'follower_id' => $profileFollowerData['follower_id']]);
                    $profileFollowerData['_id'] = $responseProfileFollower->_id; // die;
                    return Response::json(array(
                                'success' => true,
                                'message' => 'Follow',
                                'data' => $profileFollowerData
                                    ), HttpResponse::HTTP_OK);
                }else{
                    $profileFollowerData['_id'] = $responseProfileFollower->_id; // die;
                    return Response::json(array(
                                'success' => true,
                                'message' => 'Follow',
                                'data' => $profileFollowerData
                                    ), HttpResponse::HTTP_BAD_REQUEST);
                }

            
            }  else {
                
               ProfileFollower::where('profile_id', $profileFollowerData['profile_id'])
                               ->where('follower_id', $profileFollowerData['follower_id'])
                               ->update([
                                        'follow_flag' => $profileFollowerData['follow_flag'],
                                        'updated_at'=>$profileFollowerData['updated_at']
                                   ]);
                  $updateCollection = ProfileFollower::raw()->findOne(['profile_id' => $profileFollowerData['profile_id'],'follower_id' => $profileFollowerData['follower_id']]);
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
