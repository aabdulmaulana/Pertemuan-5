<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Models\Student;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//otentifikasi (register&login)
Router::post('/register', [AuthController::class, 'register']);
Router::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    //menambahkan data student
    Route::get('students', [StudentController::class, 'index'])->middleware('auth:sanctum');

    Route::post('students', [StudentController::class, 'store'])->middleware('auth:sanctum');

    Route::put('students/{id}', [StudentController::class, 'update'])->middleware('auth:sanctum');
    
    Route::delete('students/{id}', [StudentController::class, 'destroy'])->middleware('auth:sanctum');

    Route::get('students/{id}', [StudentController::class, 'show'])->middleware('auth:sanctum');


});
