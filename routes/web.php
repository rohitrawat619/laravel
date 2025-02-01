<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;


Route::resource('students', StudentController::class);

Route::get('/', [StudentController::class, 'index']); //define view on route of index function in StudentController

Route::view('/url', 'welcome')->middleware('check.age'); //Redirect to another route with old url

//example of query string passing dynamic value in url query string
Route::get('/custom/{id?}', function (string $id = null) {
     if ($id) {
          return "<h2>This is " . $id . "</h2>";
     } else {
          return "<h2>Not Found 404</h2>";
     }
});

//middleware apply on various route is callled group middleware
Route::middleware(['check.age'])->group(function () {

     Route::get('/customurl', function () {
          return view('welcome');
     })->name('random');

     Route::get('/cust', function () {
          return view('about');
     })->name('randomly');

     Route::redirect('/url', '/cust', 301);

     Route::fallback(function () {
          return "<h1> Page Not Found 404 </h1>";
     });
});
