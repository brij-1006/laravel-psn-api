<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\ProfileInterest;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon; ///  date/time
use Response;
use Storage;

class ProfileInterestController extends Controller {

    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $profileInterestData = $request->all();



        if (!$profileInterestData['profile_id']) {
            $responseCollection = array('success' => false, 'message' => 'You are not autherized!', 'data' => null);
            return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        } else {

            $date = Carbon::now();
            $profileInterestData['updated_at'] = $date->toDateTimeString();
            $profileInterestData['created_at'] = $date->toDateTimeString();
            $interestPostParam = [];
            $interestPostParam['created_at'] = $date->toDateTimeString();
            $interestPostParam['updated_at'] = $date->toDateTimeString();
            $interestPostParam['profile_id'] = $profileInterestData['profile_id'];

            $updateFlag = false;
            if (is_array($profileInterestData['interestIds'])) {

                $interestData = ProfileInterest::where('profile_id', '=', $interestPostParam['profile_id'])->get();
                foreach ($interestData as $key => $value) {
                    ProfileInterest::destroy($value['_id']);
                }

                foreach ($profileInterestData['interestIds'] as $key => $value) {
                    $interestPostParam['interest_id'] = $value;
                    $interestCollection = ProfileInterest::raw()->findOne(['profile_id' => $interestPostParam['profile_id'], 'interest_id' => $value]);
                    $responseProfileInterest = ProfileInterest::create($interestPostParam);
                    $updateFlag = true;
                }
            }

            if ($updateFlag == true) {
                $interestData = ProfileInterest::where('profile_id', '=', $interestPostParam['profile_id'])->get();
                return Response::json(array(
                            'success' => true,
                            'message' => 'Interest updated successfully',
                            'data' => $interestData
                                ), HttpResponse::HTTP_OK);
            } else {
                return Response::json(array(
                            'success' => false,
                            'message' => 'Interest not updated successfully',
                            'data' => $createCollection
                                ), HttpResponse::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
