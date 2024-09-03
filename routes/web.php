<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;


Route::resource('students', StudentController::class)->middleware('check.age');

Route::put('students/{id}', [StudentController::class, 'update'])->name('students.update');

Route::get('/get', [StudentController::class, 'index']);

Route::get('/', function () {
     return view('welcome');
});

Route::view('/url', 'welcome')->middleware('check.age');

Route::get('/custom/{id?}', function (string $id = null) {
     if ($id) {
          return "<h2>This is " . $id . "</h2>";
     } else {
          return "<h2>Not Found 404</h2>";
     }
});

Route::middleware(['check.age'])->group(function () {

     Route::get('/customurl', function () {
          return view('welcome');
     })->name('random');

     Route::get('/cust', function () {
          return view('about');
     })->name('randomly');

     Route::redirect('/url', '/cust', 301);

     Route::fallback(function () {
          return "<h1> Page Not Found";
     });
});
