<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Account\PermissionController;

Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        App::setLocale($locale);
        session()->put('locale', $locale);
    }
    return back();
})->name('locale');

Route::group(['middleware' => ['permission']], function () {
    Route::prefix('account')->group(function () {
        Route::name('account.')->group(function () {
            Route::resource('permission', PermissionController::class);
        });
    });
});


