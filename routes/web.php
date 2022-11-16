<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\paypalController;


Route::get('/',[paypalController::class,'index'])->name('index');
Route::get('payment',[paypalController::class,'payment'])->name('payment');
Route::get('cancel',[paypalController::class,'cancel'])->name('cancel');
Route::get('payment/sucess',[paypalController::class,'sucess'])->name('sucess');
