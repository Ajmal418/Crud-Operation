<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::group(['prefix'=>'dashboard' ,'middleware'=>'auth'],function(){
 Route::get('/',[StudentController::class,'dashboard'])->name('dashboard');
 Route::get('/form',[StudentController::class,'form'])->name('form');
 Route::post('/insert',[StudentController::class,'insert'])->name('insert');
 Route::post('edit',[StudentController::class,'edit'])->name('edit');
 Route::post('update',[StudentController::class,'update'])->name('update');
 Route::get('delete/{id}',[StudentController::class,'delete'])->name('delete');
});
require __DIR__.'/auth.php';
