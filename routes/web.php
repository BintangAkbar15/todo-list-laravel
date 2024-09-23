<?php

use App\Http\Controllers\Todo\TodoControllers;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('todo.app');
// });

Route::get('/',[TodoControllers::class,'index'])->name(name: 'todo'); ;
Route::post('/',[TodoControllers::class,'store'])->name('todo.post') ;
Route::put('/{task}',[TodoControllers::class,'update'])->name('todo.update') ;
Route::delete('/{id}',[TodoControllers::class,'destroy'])->name('todo.delete') ;