<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;

/***Include required Model ****/
use App\User;
use App\Models\Profile\Profile;
/*** End Here ****/
use Illuminate\Http\Request;
use Response;
use Illuminate\Mail\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Mail;
use App\Http\Controllers\Api\Transformers\UserTransformer;
use Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ValidatesRequests;

    public function __construct()
    {
        $this->middleware('api');

    }

    public function signup(Request $request) {
         $method = $request->method(); 
        if ($method != 'POST' ||  $method == '') {
             return Response::json(
                                array(
                            'success' => false,
                            'message' => $validatorErrors,
                            'data' => null), 405);
            
        } else {

            $userData = $request->all();

            $rules = [
                'mobile' => 'required|min:10|numeric',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|same:password_confirmation',
                'password_confirmation' => 'required|min:6',
            ];

            $validator = Validator::make($userData, $rules);
            
            
            
            if ($validator->fails()) {
                $validatorErrors = $validator->errors()->all();
                return Response::json(
                                array(
                            'success' => false,
                            'message' => $validatorErrors,
                            'data' => null), 400);
            }


            $user = User::create([
                        'mobile' => $userData['mobile'],
                        'email' => $userData['email'],
                        'remember' => isset($userData['remember'])?$userData['remember']:0,
                        'password_token' => str_random(60),
                        'password' => Hash::make($userData['password']),
            ]);

            //upload avatar
            if (!$user->_id) {
                $responseCollection = array('success' => false, 'message' => 'Could not create user', 'data' => null);
                return Response::json($responseCollection, 500);
            } else {
                // User association
                $profile = $user->profile()->create([
                        //'user_id' => $user->_id,
                ]);
                $responseCollection = array('success' => true, 'message' => 'User is created', 'data' => $user);
                return Response::json($responseCollection, 201);
            }
        }
    }

    public function recovery(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required'
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject(Config::get('boilerplate.recovery_email_subject'));
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->response->noContent();
            case Password::INVALID_USER:
                return $this->response->errorNotFound('Email not found');
        }
    }

    public function reset(Request $request)
    {
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $validator = Validator::make($credentials, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        if(!User::where('email', $credentials['email'])->exists())
            throw new NotFoundHttpException("Email not found");

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                if(Config::get('boilerplate.reset_token_release')) {
                    return $this->login($request);
                }
                return $this->response->noContent();

            default:
                return $this->response->error('could_not_reset_password', 500);
        }
    }
}
