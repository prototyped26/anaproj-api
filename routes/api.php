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
Route::middleware(['cors'])->group(function () {
    Route::post('login', 'API\UserController@login');
    // Route::get('logout', 'API\UserController@logout');
    Route::post('register', 'API\UserController@register');
    Route::post('login/password-reset', 'API\UserController@resetPassword');
    Route::post('login/password-new', 'API\UserController@getTokenReset');
    Route::post('login/password-valid', 'API\UserController@register2');
});

Route::middleware(['cors', 'auth:api'])->group(function () {
    Route::get('logout', 'API\UserController@logout');
});



Route::get('auth-login', function (Request $request) {
   return response()->json(['error' => 'Authorization'], 401);
})->name('auth-login');

Route::middleware([ 'cors', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->prefix('file')->group(function () {
    Route::post('/uplaoad-img-base64', 'API\UploadFiles@saveFileWithBase64');
});

//user
Route::middleware(['cors'])->prefix('user')->group(function () {
    Route::post('/edit', 'API\UserController@editInformations');
});

/// contents CycleController
///->prefix('content')-


Route::middleware([ 'cors', 'auth:api'])->prefix('users')->group(function () {
    Route::get('/', 'API\UserController@list');
    Route::get('/{id}', 'API\UserController@detail');

    Route::put('/{id}', 'API\UserController@update');
    Route::put('/user/{id}', 'API\UserController@update2');

    Route::delete('/{id}', 'API\CycleController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('cycles')->group(function () {
    Route::get('/', 'API\CycleController@list');
    Route::get('/{id}', 'API\CycleController@detail');

    Route::post('/new', 'API\CycleController@store');
    Route::post('/{id}', 'API\CycleController@update');

    Route::delete('/{id}', 'API\CycleController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('filieres')->group(function () {
    Route::get('/', 'API\FiliereController@list');
    Route::get('/{id}', 'API\FiliereController@detail');

    Route::post('/new', 'API\FiliereController@store');
    Route::put('/update', 'API\FiliereController@update');

    Route::delete('/{id}', 'API\FiliereController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('options')->group(function () {
    Route::get('/', 'API\OptionController@list');
    Route::get('/{id}', 'API\OptionController@detail');

    Route::post('/new', 'API\OptionController@store');
    Route::put('/update', 'API\OptionController@update');

    Route::delete('/{id}', 'API\OptionController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('epreuves')->group(function () {
    Route::get('/', 'API\EpreuveController@list');
    Route::get('/{id}', 'API\EpreuveController@detail');

    Route::post('/new', 'API\EpreuveController@store');
    Route::put('/update', 'API\EpreuveController@update');

    Route::delete('/{id}', 'API\EpreuveController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('posts')->group(function () {
    Route::get('/', 'API\PostController@list');
    Route::get('/{id}', 'API\PostController@detail');

    Route::post('/', 'API\PostController@store');
    Route::put('/{id}', 'API\PostController@update');

    Route::delete('/{id}', 'API\PostController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('categories')->group(function () {
    Route::get('/', 'API\CategorieController@list');
    Route::get('/{id}', 'API\CategorieController@detail');

    Route::post('/', 'API\CategorieController@store');
    Route::put('/{id}', 'API\CategorieController@update');

    Route::delete('/{id}', 'API\CategorieController@delete');
});

/// les contenus
///
Route::middleware([ 'cors', 'auth:api'])->prefix('messages')->group(function () {
    Route::get('/', 'API\MessageController@list');
    Route::get('/{id}', 'API\MessageController@detail');

    Route::post('/', 'API\MessageController@store');
    Route::put('/{id}', 'API\MessageController@update');

    Route::delete('/{id}', 'API\MessageController@delete');
});
///
Route::middleware([ 'cors', 'auth:api'])->prefix('types')->group(function () {
    Route::get('/', 'API\TypeContentController@list');
    Route::get('/{id}', 'API\TypeContentController@detail');

    Route::post('/', 'API\TypeContentController@store');
    Route::put('/{id}', 'API\TypeContentController@update');

    Route::delete('/{id}', 'API\TypeContentController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('contenus')->group(function () {
    Route::get('/', 'API\ContentController@list');
    //Route::get('/type/{type}', 'API\ContentController@listByType');
    //Route::get('/{id}', 'API\ContentController@detail');

    Route::post('/', 'API\ContentController@store');
    Route::put('/{id}', 'API\ContentController@update');

    Route::delete('/{id}', 'API\ContentController@delete');
});
Route::middleware([ 'cors'])->prefix('contenus')->group(function () {
    Route::get('/type/{type}', 'API\ContentController@listByType');
    Route::get('/{id}', 'API\ContentController@detail');
    Route::get('/lien/{lien}', 'API\ContentController@contenuByLink');
});
////////////////////////

Route::middleware([ 'cors', 'auth:api'])->prefix('events')->group(function () {
    Route::get('/', 'API\EventController@list');
    Route::get('/{id}', 'API\EventController@detail');

    Route::post('/', 'API\EventController@store');
    Route::put('/{id}', 'API\EventController@update');

    Route::delete('/{id}', 'API\EventController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('employes')->group(function () {
    Route::get('/', 'API\EmployeController@list');
    Route::get('/{id}', 'API\EmployeController@detail');

    Route::post('/', 'API\EmployeController@store');
    Route::put('/{id}', 'API\EmployeController@update');

    Route::delete('/{id}', 'API\EmployeController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('clients')->group(function () {
    Route::get('/', 'API\ClientController@list');
    Route::get('/{id}', 'API\ClientController@detail');

    Route::post('/', 'API\ClientController@store');
    Route::put('/{id}', 'API\ClientController@update');

    Route::delete('/{id}', 'API\ClientController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('professions')->group(function () {
    Route::get('/', 'API\ProfessionController@list');
    Route::get('/{id}', 'API\ProfessionController@detail');

    Route::post('/', 'API\ProfessionController@store');
    Route::put('/{id}', 'API\ProfessionController@update');

    Route::delete('/{id}', 'API\ProfessionController@delete');
});

Route::middleware([ 'cors', 'auth:api'])->prefix('roles')->group(function () {
    Route::get('/', 'API\RoleController@list');
    Route::get('/{id}', 'API\RoleController@detail');

    Route::post('/', 'API\RoleController@store');
    Route::put('/{id}', 'API\RoleController@update');

    Route::delete('/{id}', 'API\RoleController@delete');
});

/*Route::middleware([ 'cors', 'auth:api'])->group(function () {
    Route::post('/upsert', 'API\ContentController@upSert');
    Route::post('/element', 'API\ContentController@addElementToContent');


    Route::get('/my/{user}', 'API\ContentController@getMyContents');
    //Route::get('/one/{id}', 'API\ContentController@getContent');
    Route::post('/like', 'API\ContentController@likeContent');
    Route::post('/follow', 'API\ContentController@followCreator');
    Route::post('/comment', 'API\ContentController@commentContent');
    Route::get('/my/like/{user}', 'API\ContentController@myLikeContents');
    Route::get('/my/follow/{user}', 'API\ContentController@myFollowContents');

    Route::delete('/element/{id}', 'API\ContentController@deleteElementToContent');
    Route::delete('/{id}', 'API\ContentController@deleteContent');
});*/
