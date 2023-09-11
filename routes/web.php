<?php

use App\Http\Controllers\AmountSlabController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFaqController;
use App\Http\Controllers\ProjectUpdateController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->group(['prefix' => 'user'], function () use ($router) {
        Route::controller(UserController::class)->group(function () {
            Route::post('login', 'login')->name('login');
            Route::post('register', 'register')->name('register');
            Route::post('token-verification', 'tokenVerification')->name('token-verification');
            Route::post('verification-mail-resend', "verificationMailReSend")->name("verification-mail-resend");
        });
    });
    $router->group(['prefix' => 'country'], function () {
        Route::controller(CountryController::class)->group(function () {
            Route::get('list', 'index')->name('index');
        });
    });

    $router->group(['prefix' => 'currency'], function () {
        Route::controller(CountryController::class)->group(function () {
            Route::get('list', 'currencyList');
        });
    });

    $router->group(['prefix' => 'category'], function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('list', 'index')->name('index');
        });
    });

    $router->group(['prefix' => 'project'], function () use ($router) {
        Route::controller(ProjectController::class)->group(function () {
            Route::get('live-project-list', 'liveProjectList')->name('live-project-list');
        });

    });

    Route::group(['middleware' => ['jwt.verify']], function () use ($router) {
        $router->group(['prefix' => 'user'], function () {
            Route::controller(UserController::class)->group(function () {
                Route::post('logout', 'logout')->name('logout');
                Route::get('profile/show', 'show');
                Route::post('profile/update', 'profileUpdate');
            });
        });

        $router->group(['prefix' => 'country'], function () {
            Route::controller(CountryController::class)->group(function () {
                Route::post('create', 'create')->name('create');
                Route::put('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
                Route::get('show/{id}', 'show')->name('show');
            });
        });

        $router->group(['prefix' => 'category'], function () {
            Route::controller(CategoryController::class)->group(function () {
                Route::post('create', 'create')->name('create');
                Route::put('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
                Route::get('show/{id}', 'show')->name('show');
            });
        });

        $router->group(['prefix' => 'currency'], function () {
            Route::controller(CurrencyController::class)->group(function () {
                Route::post('create', 'create')->name('create');
                Route::put('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
                Route::get('show/{id}', 'show')->name('show');
            });
        });

        $router->group(['prefix' => 'bank-account'], function () {
            Route::controller(BankAccountController::class)->group(function () {
                Route::post('create', 'create')->name('create');
                Route::put('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
                Route::get('show/{id}', 'show')->name('show');
                Route::get('list', 'index')->name('index');
            });
        });

        $router->group(['prefix' => 'comment'], function () {
            Route::controller(CommentController::class)->group(function () {
                Route::post('create', 'create')->name('create');
                Route::put('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
                Route::get('show/{id}', 'show')->name('show');
                Route::get('list', 'index')->name('index');
            });
        });

        $router->group(['prefix' => 'project'], function () use ($router) {
            Route::controller(ProjectController::class)->group(function () {
                // Route::post('create', 'createOld')->name('create');
                Route::post('create', 'create')->name('create');
                Route::get('list', 'index')->name('index');
                Route::get('my/list', 'listByUser');
                Route::put('updatePhase/{id}', 'updatePhase')->name('updatePhase');
                Route::get('show/{id}', 'show')->name('show');
                Route::post('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
                Route::post('upload-image', 'uploadImage')->name('upload-image');
                Route::delete('delete-image/{id}', 'deleteImage')->name('delete-image');
            });

            $router->group(['prefix' => 'amount-slab'], function () {
                Route::controller(AmountSlabController::class)->group(function () {
                    Route::post('create', 'create')->name('create');
                    Route::get('list/{project_id}', 'index')->name('index');
                    Route::put('update', 'update')->name('update');
                    Route::delete('delete/{id}', 'delete')->name('delete');
                    Route::get('show/{id}', 'show')->name('show');
                });
            });
        });

        $router->group(['prefix' => 'faq'], function () use ($router) {
            Route::controller(ProjectFaqController::class)->group(function () {
                Route::post('create', 'create')->name('create');
                Route::get('list', 'index')->name('index');
                Route::get('project/{id}', 'listByProject');
                Route::get('show/{id}', 'show')->name('show');
                Route::post('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
            });
        });

        $router->group(['prefix' => 'project-update'], function () use ($router) {
            Route::controller(ProjectUpdateController::class)->group(function () {
                Route::post('create', 'create')->name('create');
                Route::get('list', 'index')->name('index');
                Route::get('project/{id}', 'listByProject');
                Route::get('show/{id}', 'show')->name('show');
                Route::post('update', 'update')->name('update');
                Route::delete('delete/{id}', 'delete')->name('delete');
            });
        });

        $router->group(['prefix' => 'role'], function () use ($router) {
            Route::controller(RoleController::class)->group(function () {
                Route::get('list', 'index')->name('index');
                Route::post('create', 'create')->name('create');
                Route::post('update', 'update')->name('update');
                Route::get('show/{id}', 'show')->name('show');
                Route::delete('delete/{id}', 'delete')->name('delete');
            });
        });

        $router->group(['prefix' => 'permission'], function () use ($router) {
            Route::controller(PermissionController::class)->group(function () {
                Route::get('list', 'index')->name('index');
            });
        });
    });
});
