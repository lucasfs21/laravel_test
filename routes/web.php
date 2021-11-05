<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FundController;

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
Route::group(['as' => 'patrimonies.'], function () {
    Route::get('patrimonies/index', [FundController::class, 'index'])->name('index');
    Route::get('patrimonies/new', [FundController::class, 'new'])->name('new');
    Route::post('patrimonies/save', [FundController::class, 'save'])->name('save');
    Route::get('patrimonies/edit/{id}', [FundController::class, 'edit'])->name('edit');
    Route::post('patrimonies/update', [FundController::class, 'update'])->name('update');
    Route::delete('patrimonies/delete/{id?}', [FundController::class, 'delete'])->name('delete');
    Route::post('patrimonies/fund_assets', [FundController::class, 'searchForFundAssets'])->name('search_for_fund_assets');
});
