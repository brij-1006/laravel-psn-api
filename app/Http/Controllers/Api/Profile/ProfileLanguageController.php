<?php

namespace App\Http\Controllers\Api\Profile;

use App\Models\Profile\Profile as Profile;
use App\Models\Language;
use App\Models\Profile\ProfileLanguage;
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

class ProfileLanguageController extends Controller
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

        $profileLanguageData = $request->all();
        $profile_id = $profileLanguageData['id'];
        $langCollection = ProfileLanguage::where('profile_id', '=', $profile_id)->get();
        $langIds = [];
        foreach ($langCollection as $key => $value) {
            $langIds[] = $value->language_id;
        }
        $userLang = Language::whereIn('_id', $langIds)->get();
        $profileLanguage = array();
        foreach ($userLang as $key => $value) {
            $profileLanguage[$key]['language_id'] = $value->_id;
            $profileLanguage[$key]['language'] = $value->language;
        }

        if (!isset($profileLanguage)) {
            $responseCollection = array('success' => false, 'message' => 'Language not exist!', 'data' => null);
            return Response::json($responseCollection, HttpResponse::HTTP_OK);
        } else {
            $responseCollection = array('success' => true, 'data' => $profileLanguage);
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
        $profileLanguageData = $request->all();
        
        if($profileLanguageData['language_id'] == ''){
            $responseCollection = array('success' => false, 'message' => 'Please provide language', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }
        
        $getLanguageData = Language::find($profileLanguageData['language_id']);
        
        if(!$profileLanguageData['profile_id']){
            $responseCollection = array('success' => false, 'message' => 'Please provide profile id', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }else{
            $date = Carbon::now();
            $profileLanguageData['created_at']  =  $date->toDateTimeString();
            $profileLanguageData['updated_at']  =  $date->toDateTimeString();
            $numRows = ProfileLanguage::where(['profile_id' => $profileLanguageData['profile_id'],'language_id' => $profileLanguageData['language_id']])->count();
            if($numRows == 0){
                $responseProfileLanguage = ProfileLanguage::create($profileLanguageData);
                $newCollection = ProfileLanguage::find($responseProfileLanguage->_id);
                $newCollection['language'] = $getLanguageData['language'];
                $responseCollection = array('success' => true,'message' =>'Language saved successfully','data' => $newCollection);
               return  Response::json($responseCollection,HttpResponse::HTTP_OK); 
            }  else {
              
               ProfileLanguage::where('profile_id', $profileLanguageData['profile_id'])
                               ->where('language_id', $profileLanguageData['language_id'])
                               ->update([
                                        'language_id' => $profileLanguageData['language_id'],
                                        'updated_at'=>$profileLanguageData['updated_at']
                                   ]);
                  $updateCollection = ProfileLanguage::raw()->findOne(['profile_id' => $profileLanguageData['profile_id'],'language_id' => $profileLanguageData['language_id']]);
                  $updateCollection['language'] = $getLanguageData['language'];
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
        
        $language = array();
        $lang = ProfileLanguage::find($id);
         $language['profile_id'] = $lang->profile_id; // die;
        $langCollection = ProfileLanguage::where('profile_id', '=', $language['profile_id'])->get();//->where('name', '=', 'John')->get();
       
        $langIds = [];
        foreach ($langCollection as $key => $value) {
            $langIds[]  = $value->language_id;
        }
        
        $userLang = Language::whereIn('_id', $langIds)->get();
        $profileLanguage = array();
        foreach ($userLang  as $key => $value) {
           $profileLanguage[$key]['language_id'] = $value->_id;
           $profileLanguage[$key]['language'] = $value->language;
        }    

       echo '<pre>';
          print_r($profileLanguage);
       echo '</pre>';
       
        
        
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
