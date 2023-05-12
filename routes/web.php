<?php

use App\Http\Controllers\LoanRepaymentController;
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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if ( Auth::id() )
        return redirect('/userHomePage');

    return view('user.login');
});

Route::get('/admin', function () {
    if ( Auth::id() )
        return redirect('/adminHomePage');

    return view('admin.login');
});

Route::post('/adminLogin', [UserController::class, 'adminLogin']); //done


//Public User API
Route::post('/login', [UserController::class, 'userLogin'])->name('login'); //done
Route::post('/signUp', [UserController::class, 'createUser']);
Route::get('showLoanTypes', [LoanTypeController::class, 'index']);

//User API
Route::get('/logout', [UserController::class, 'logout'])->middleware('user')->name('logout'); //done

Route::get('/applyForLoan/{id}', [UserLoanController::class, 'applyForLoan'])->middleware('user')->name('applyForLoan');//done
Route::get('/premiumPayment/{id}', [UserLoanController::class, 'premiumPayment'])->middleware('user');//done
Route::get('/myUpcomingPremium', [UserLoanController::class, 'myUpcomingPremiums'])->middleware('user');//done
Route::get('/loanHistory', [UserLoanController::class, 'myLoans'])->middleware('user');//done
Route::get('/loanDetail/{id}', [UserLoanController::class, 'loanDetail'])->middleware('user');//done

Route::get('/repaymentHistory', [LoanRepaymentController::class, 'repaymentHistory'])->middleware('user');//done
Route::get('/repaymentDetail/{id}', [LoanRepaymentController::class, 'repaymentDetail'])->middleware('user'); //check others record should not come
Route::get('/earlyLoanClosure/{id}', [LoanRepaymentController::class, 'closeLoanEarly'])->middleware('user');//done

//Admin API
Route::group(['middleware' => ['admin']], function () {
    Route::post('/createUser', [UserController::class, 'createUser']);//done
    Route::get('/approveLoan/{id}', [UserLoanController::class, 'approveLoan']);//done
    Route::get('/rejectLoan/{id}', [UserLoanController::class, 'rejectLoan']);//done
    Route::get('/defaultLoan/{id}', [UserLoanController::class, 'defaultedLoan']);//done
    Route::get('/verifyPayment/{id}', [UserLoanController::class, 'verifyPayment']);//done
    Route::get('/loanDue', [UserLoanController::class, 'allPaymentPending']); //done
    Route::get('/allLoan', [UserLoanController::class, '']);
    Route::get('/allPayment', [UserLoanController::class, 'allPayment']); //done

    Route::resources([
        'lookupTypes'  => LookupTypeController::class,
        'lookupValues' => LookupValueController::class,
        'loanTypes'    => LoanTypeController::class,
    ]); //done except delete call
});

Route::get('/testing', [TestController::class, 'test'])->name('testing');

Route::get('/userHomePage', [LoanTypeController::class, 'returnUserHomePage'])->middleware('user')->name('userHomePage');
Route::get('/adminHomePage', [UserController::class, 'returnAdminHomePage'])->middleware('admin')->name('adminHomePage');
Route::get('/loanType', [LoanTypeController::class, 'returnLoanTypes'])->middleware('admin')->name('loanType');

Route::get('/createLoanTypeForm', function () {
    return view('admin.createLoan');
});






