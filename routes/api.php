<?php

use App\Presentation\Http\Controllers\Api\V1\Auth\{
    UserController,
    RegisterController,
    LoginController,
    AuthAdminController,
};
use App\Presentation\Http\Controllers\Api\V1\{
    CategoryController,
    ProductController,
    CountryController,
    CityController,
};
use Illuminate\Support\Facades\Route;


Route::prefix('user/v1')->group(
    function () {


        // -------------------------------- Auth -------------------------------------------//
        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/login', [LoginController::class, 'login']);

        // ------------------------------- Products ----------------------------------------//

        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/{id}', [ProductController::class, 'show']);

        // -------------------------------- Category ----------------------------------------//

        Route::prefix('/categories')->group(
            function () {
                Route::get('/', [CategoryController::class, 'index']);
                Route::get('/{id}', [CategoryController::class, 'show']);
            }
        );

        // ------------------------------- Country -------------------------------------------//

        Route::prefix('/countries')->group(
            function () {
                Route::get('/', [CountryController::class, 'index']);
                Route::get('/{id}', [CountryController::class, 'show']);
                Route::get('/by-country/{countryId}', [CityController::class, 'findByCountry']);
            }
        );

        // ------------------------------- City -------------------------------------------//

        Route::prefix('/cities')->group(
            function () {
                Route::get('/', [CityController::class, 'index']);
                Route::get('/{id}', [CityController::class, 'show']);
                Route::get('/by-country/{countryId}', [CityController::class, 'findByCountry']);
            }
        );


        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [UserController::class, 'logout']);
            Route::get('/profile', [UserController::class, 'profile']);
            Route::put('/profile', [UserController::class, 'update']);
            Route::patch('/profile', [UserController::class, 'update']);
            Route::delete('/profile', [UserController::class, 'destroyProfile']);
        });
    }
);

Route::prefix('admin/v1')->group(function () {
    Route::post('/login', [AuthAdminController::class, 'loginAdmin']);
});

Route::prefix('admin/v1')->middleware(['auth:sanctum', 'admin'])->group(
    function () {
        // ------------------------------- Products ----------------------------------------//
        Route::prefix('/products')->group(
            function () {
                Route::get('/', [ProductController::class, 'index']);
                Route::post('/', [ProductController::class, 'store']);
                Route::get('/{id}', [ProductController::class, 'show']);
                Route::patch('/{id}', [ProductController::class, 'update']);
                Route::put('/{id}', [ProductController::class, 'update']);
                Route::delete('/{id}', [ProductController::class, 'destroy']);
            }
        );

        // -------------------------------- Category ----------------------------------------//

        Route::prefix('/categories')->group(
            function () {
                Route::get('/', [CategoryController::class, 'index']);
                Route::get('/{id}', [CategoryController::class, 'show']);
                Route::post('/', [CategoryController::class, 'store']);
                Route::patch('/{id}', [CategoryController::class, 'update']);
                Route::put('/{id}', [CategoryController::class, 'update']);
                Route::delete('/{id}', [CategoryController::class, 'destroy']);
            }
        );

        // -------------------------------- Country ----------------------------------------//

        Route::prefix('/countries')->group(
            function () {
                Route::get('/', [CountryController::class, 'index']);
                Route::get('/{id}', [CountryController::class, 'show']);
                Route::post('/', [CountryController::class, 'store']);
                Route::patch('/{id}', [CountryController::class, 'update']);
                Route::put('/{id}', [CountryController::class, 'update']);
                Route::delete('/{id}', [CountryController::class, 'destroy']);
                Route::get('/code/{code}', [CountryController::class, 'findByCode']);
            }
        );

        // -------------------------------- City ----------------------------------------//

        Route::prefix('/cities')->group(
            function () {
                Route::get('/', [CityController::class, 'index']);
                Route::get('/{id}', [CityController::class, 'show']);
                Route::post('/', [CityController::class, 'store']);
                Route::patch('/{id}', [CityController::class, 'update']);
                Route::put('/{id}', [CityController::class, 'update']);
                Route::delete('/{id}', [CityController::class, 'destroy']);
                Route::get('/by-country/{countryId}', [CityController::class, 'findByCountry']);
            }
        );

        // ------------------------------- Users ---------------------------------------------//

        Route::prefix('users')->group(
            function () {
                Route::get('/', [UserController::class, 'index']);
                Route::get('/{id}', [UserController::class, 'show']);
                Route::patch('/{id}', [UserController::class, 'update']);
                Route::put('/{id}', [UserController::class, 'update']);
                Route::delete('/{id}', [UserController::class, 'destroy']);

                Route::middleware('auth:sanctum')->group(function () {
                    Route::post('/logout', [UserController::class, 'logout']);
                    Route::get('/profile', [UserController::class, 'profile']);
                    Route::put('/profile', [UserController::class, 'update']);
                    Route::patch('/profile', [UserController::class, 'update']);
                    Route::delete('/profile', [UserController::class, 'destroyProfile']);
                });
            }
        );

        // ------------------------------- Admin Users ---------------------------------------------//

        Route::prefix('')->group(
            function () {
                Route::post('/register', [AuthAdminController::class, 'registerAdmin']);
                Route::put('/update/{id}', [AuthAdminController::class, 'updateAdmin']);
                Route::delete('/delete/{id}', [AuthAdminController::class, 'deleteAdmin']);
                Route::patch('/promote/{id}', [AuthAdminController::class, 'promoteToAdmin']);
            }
        );
    }
);
