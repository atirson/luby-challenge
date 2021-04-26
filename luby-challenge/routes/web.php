<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentTestGradeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return json_encode(['API_LUB' => 'Run on port 8000']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'student'
], function ($router) {
    Route::post('create', [StudentController::class, 'create']);
    Route::put('update', [StudentController::class, 'update']);
    Route::delete('delete', [StudentController::class, 'delete']);
    Route::get('list', [StudentController::class, 'list']);

    Route::post('test_grade', [StudentTestGradeController::class, 'addTestGrade']);
});

require __DIR__.'/auth.php';
