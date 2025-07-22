<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/test', [App\Http\Controllers\AdminDashboardHome::class, 'index'])->name('test');

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('home');

Route::get('/services', [App\Http\Controllers\DisplayService::class, 'index'])->name('services');
Route::get('/services/{slug}', [App\Http\Controllers\DisplayService::class, 'show'])->name('view-service');

// Route::get('/services/{id}', [App\Http\Controllers\ServiceDisplay::class, 'show'])->name('services.show');
Route::get('/deals', [App\Http\Controllers\DisplayDeal::class, 'index'])->name('deals');
Route::get('/deals/{deal}', [App\Http\Controllers\DisplayDeal::class, 'show'])->name('view-deal');

// Users needs to be logged in for these routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardHomeController::class, 'index'])->name('dashboard');

        // middleware to give access only for owner
        Route::middleware([
            'validateRole:Owner',
        ])->group(function () {

            Route::prefix('manage')->group(function () {
                Route::resource('users', App\Http\Controllers\UserController::class)->name('index', 'manageusers');
                Route::put('users/{id}/suspend', [App\Http\Controllers\UserSuspensionController::class, 'suspend'])->name('manageusers.suspend');
                Route::put('users/{id}/activate', [App\Http\Controllers\UserSuspensionController::class, 'activate'])->name('manageusers.activate');
            });

        });

        // middlleware to give access only for owner and cashier
        Route::middleware([
            'validateRole:Owner,Cashier',
        ])->group(function () {

            Route::prefix('manage')->group(function () {
                Route::get('locations', function () {
                    return view('dashboard.manage-locations.index');
                })->name('managelocations');

                Route::get('services', function () {
                    return view('dashboard.manage-services.index');
                })->name('manageservices');

                Route::get('deals', function () {
                    return view('dashboard.manage-deals.index');
                })->name('managedeals');

                Route::get('categories', function () {
                    return view('dashboard.manage-categories.index');
                })->name('managecategories');

                Route::get('categories/create', function () {
                    return view('dashboard.manage-categories.index');
                })->name('managecategories.create');

                Route::get('appointments', function () {
                    return view('dashboard.manage-appointments.index');
                })->name('manageappointments');

                Route::get('transaction-history', [App\Http\Controllers\Dashboard\CashierTransactionHistoryController::class, 'index'])->name('cashier.history');
            });
        });

        Route::middleware([
            'validateRole:Customer',
        ])->group(function () {

            Route::prefix('cart')->group(function () {
                Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
                Route::post('/', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
                Route::delete('/item/{cart_service_id}', [App\Http\Controllers\CartController::class, 'removeItem'])->name('cart.remove-item');
                Route::delete('/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
                Route::post('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
            });

            Route::get('history', function () {
                return view('dashboard.customer-transaction-history');
            })->name('history');

        });
    });
});