<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;


Route::resource('students', StudentController::class);

Route::get('/', [StudentController::class, 'index']); //define view on route of index function in StudentController

//example of query string passing dynamic value in url query string
Route::get('/custom/{id?}', function (string $id = null) {
     if ($id) {
          return "<h2>This is " . $id . "</h2>";
     } else {
          return "<h2>url are not with query string</h2>";
     }
});


Route::view('/show', 'welcome'); // redirect view

//middleware apply on various route is callled group middleware
Route::middleware(['check.age'])->group(function () {

     Route::get('/welcome', function () {
          return view('welcome');
     });

     Route::get('/about', function () {
          return view('about');
     });

});

Route::fallback(function () {
     return "<h1> Page Not Found 404 </h1>";
});