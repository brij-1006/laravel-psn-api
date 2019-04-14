<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\ProfileAddress;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon; ///  date/time
use Response;
use Storage;

class ProfileAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }
    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
                    'profile_id' => 'required|string',
                    'address' => 'required|string',
                    'address_flag' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $profileAddressData = $request->all();
        $profile_id = $profileAddressData['id'];
        $addressCollection = ProfileAddress::where('profile_id', '=', $profile_id)->get();
        if (!isset($addressCollection)) {
            $responseCollection = array('success' => false, 'message' => 'Address not exist!', 'data' => null);
            return Response::json($responseCollection, HttpResponse::HTTP_OK);
        } else {
            $responseCollection = array('success' => true, 'data' => $addressCollection);
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
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  address_flag :-   1 for current address ,2- Work address , 3- Home Address,  0 for other address
        $profileAddressData = $request->all();
        if(!$profileAddressData['profile_id']){
            $responseCollection = array('success' => false, 'message' => 'Please provide profile id', 'data' => null);
                return Response::json($responseCollection, HttpResponse::HTTP_BAD_REQUEST);
        }else{
             
            $date = Carbon::now();
            $profileAddressData['updated_at']  =  $date->toDateTimeString();
            $numRows = ProfileAddress::where(['profile_id' => $profileAddressData['profile_id'],'address_flag' => $profileAddressData['address_flag']])->count();
           
            if ($numRows == 0) {
                $profileAddressData['created_at']  =  $date->toDateTimeString();
                $responseProfileAddress = ProfileAddress::create($profileAddressData);
                $createCollection = ProfileAddress::find($responseProfileAddress->_id);
                return Response::json(array(
                            'success' => true,
                            'message' => 'Address saved successfully',
                            'data' => $createCollection
                                ), HttpResponse::HTTP_OK);
            } else {
                
                ProfileAddress::where('profile_id', $profileAddressData['profile_id'])
                               ->where('address_flag', $profileAddressData['address_flag'])
                               ->update([
                                        'address' => $profileAddressData['address'],
                                        'phone' => $profileAddressData['phone'],
                                        'email' => $profileAddressData['email'],
                                        'chat_id' => $profileAddressData['chat_id'],
                                        'address_flag' => $profileAddressData['address_flag'],
                                        'city' => $profileAddressData['city'],
                                        'state' => $profileAddressData['state'],
                                        'country' => $profileAddressData['country'],
                                        'updated_at'=>$profileAddressData['updated_at']
                                   ]);
                  $updateCollection = ProfileAddress::raw()->findOne(['profile_id' => $profileAddressData['profile_id'],'address_flag' => $profileAddressData['address_flag']]);
                  $responseCollection = array('success' => true,'message' =>'Place address update successfully','data' => $updateCollection);
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
