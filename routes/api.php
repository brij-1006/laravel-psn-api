<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([],function() {
    Route::post('user/signup', 'Api\AuthController@signup');
    Route::post('user/recovery', 'Api\AuthController@recovery');
    Route::post('user/reset', 'Api\AuthController@reset');

//    Route::get('/me', function (Request $request) {
//        return $request->user();
//    });

   /**** Fot Profile *****/
    Route::resource('me', 'Api\Profile\ProfileController');
    Route::post('avatar', 'Api\Profile\ProfileController@avatar');
    Route::group(['prefix' => 'profile'], function () {
        Route::resource('address', 'Api\Profile\ProfileAddressController');
        Route::resource('education', 'Api\Profile\ProfileEducationController');
        Route::resource('family', 'Api\Profile\ProfileFamilyController');
        Route::resource('follower', 'Api\Profile\ProfileFollowerController');
        Route::resource('history', 'Api\Profile\ProfileHistoryController');
        Route::resource('interest', 'Api\Profile\ProfileInterestController');
        Route::resource('language', 'Api\Profile\ProfileLanguageController');
        Route::resource('loginhistory', 'Api\Profile\ProfileLoginHistoryController');
        Route::resource('place', 'Api\Profile\ProfilePlaceController');
        Route::resource('attribute', 'Api\Profile\ProfileVisibilityController');
    });


    
    
    
    
   
    /******** End Here Profile *********/
    
    /******** Fot Content Sharing*********/
    Route::resource('content', 'Api\ContentSharing\ContentController');
    Route::resource('content/text', 'Api\ContentSharing\ContentTextController');
    Route::resource('content/media', 'Api\ContentSharing\ContentMediaController');
    Route::resource('content/like', 'Api\ContentSharing\ContentLikeController');
    Route::resource('content/share', 'Api\ContentSharing\ContentShareController');
    Route::resource('content/sharewith', 'Api\ContentSharing\ContentShareWithController');
    Route::resource('content/comment', 'Api\ContentSharing\ContentCommentController');
    Route::resource('content/commentmedia', 'Api\ContentSharing\ContentCommentMediaController');
    Route::resource('content/tag/with', 'Api\ContentSharing\ContentTagWithController');
    Route::resource('content/hashtag', 'Api\ContentSharing\ContentHashTagController');
    /******** End Content Sharing *********/
    
});
