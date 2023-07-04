<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('/')->as('member.')->group(function() {

    //show all members
    Route::get('/show-all', [MemberController::class, 'index'])->name('show_all');

    //show member by ID
    Route::get('/show-id/{id}', [MemberController::class, 'showId'])->name('show_by_id');

    //store member
    Route::post('/store', [MemberController::class, 'store'])->name('store');

    //update member
    Route::put('/edit/{id}', [MemberController::class, 'edit'])->name('update');

    //delete member by ID
    Route::delete('/delete/{id}', [MemberController::class, 'destroy'])->name('delete');

    //show member by name or character name
    Route::get('/search/{name}', [MemberController::class, 'show'])->name('show_by_name_or_char');

});