<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function() {
    $credentials = [
        'email' => 'admin@admin.es',
        'password' => 'password'
    ];

    //if user doesn't exist, we create user and assign tokens
    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = $credentials['password'];

        $user->save();

        $adminToken = $user->createToken('admin-token', ['create','update','delete']);
        $updateToken = $user->createToken('update-token', ['create','update']);
        $basicToken = $user->createToken('basic-token');

        return [
            'admin' => $adminToken->plainTextToken,
            'update' => $updateToken->plainTextToken,
            'basic' => $basicToken->plainTextToken,
        ];

        /*
        {
            "admin":"1|i7Wrt6SDL9A1c25rXVodDZeEmGo2qRZFoAOkx3TK",
            "update":"2|KRQ2C00C1k2eW7SgyKk0T0RNrDkDJQg9EugRYxLH",
            "basic":"3|JrB2U5hq6ZUzbNEGVOKIN4Lg3S2sNW1HNN1u2AsO"
        }
        */
    }

});
