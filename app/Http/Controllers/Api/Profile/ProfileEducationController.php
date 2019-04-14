<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\ProfileEducation;
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

class ProfileEducationController extends Controller
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
        $profileEducationData = $request->all();
        if(!$profileEducationData['profile_id']){
            $responseCollection = array('success' => false, 'message' => 'Please provide profile id', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }else{
            $date = Carbon::now();
            $profileEducationData['created_at']  =  $date->toDateTimeString();
            $profileEducationData['updated_at']  =  $date->toDateTimeString();
            $responseProfileEducation = ProfileEducation::create($profileEducationData);
            $newCollection = ProfileEducation::find($responseProfileEducation->_id);
           return  Response::json(array(
                'success' => true,
                'message' =>'Education detail saved successfully',
                'data' => $newCollection
            ),HttpResponse::HTTP_OK);
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
