<?php

use App\Http\Controllers\LoanTypeController;
use App\Http\Controllers\LookupTypeController;
use App\Http\Controllers\LookupValueController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
*/
//Public User API
Route::post('login', [UserController::class, 'userLogin'])->name('login'); //done
Route::middleware(['auth:api'])->group(function () {
    Route::middleware(['customer'])->group(function () {
        Route::get('showLoanTypes', [LoanTypeController::class, 'index']);
        Route::get('/logout', [UserController::class, 'logout'])->name('logout'); //done
        Route::get('/applyForLoan/{id}', [UserLoanController::class, 'applyForLoan']); //done
        Route::post('/premiumPayment', [UserLoanController::class, 'premiumPayment']); //done
        Route::get('/myUpcomingPremium', [UserLoanController::class, 'myUpcomingPremiums']); //done
        Route::get('/loanHistory', [UserLoanController::class, 'myLoans']); //done
        Route::get('/loanDetail/{id}', [UserLoanController::class, 'loanDetail']); //done
    });
});


//Admin API
Route::group(['middleware' => ['admin']], function () {
    Route::post('/createUser', [UserController::class, 'createUser']);//done
    Route::put('/changeLoanStatus/{loan_id}', [UserLoanController::class, 'changeLoanStatus']);//done
});






