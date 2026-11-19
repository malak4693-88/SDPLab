
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\borrowingsController;

// Public Staff Login
Route::post("/staff/login", [StaffAuthController::class, "login"]);

// Protected Staff Routes
Route::middleware('auth:staff')->group(function () {

    Route::delete("/staff/{id}", [StaffController::class, "destroy"]);
    Route::get("/staff", [StaffController::class, "index"]);
    Route::get("/staff/{id}", [StaffController::class, "show"]);
    Route::put("/staff/{id}", [StaffController::class, "update"]);
    Route::post("/staff", [StaffController::class, "store"]);

    Route::get("/staff-me", [StaffAuthController::class, "me"]);
    Route::post("/staff-logout", [StaffAuthController::class, "logout"]);

    // Category Routes - Staff Only
    Route::post("/category", [CategoryController::class, "store"]);
    Route::put("/category/{category}", [CategoryController::class, "update"]);
    Route::delete("/category/{category}", [CategoryController::class, "destroy"]);

    // Book Routes - Staff Only
    Route::post("/book", [BookController::class, "store"]);
    Route::put("/book/{book}", [BookController::class, "update"]);
    Route::delete("/book/{book}", [BookController::class, "destroy"]);

    // Mark a Borrowed Book as Returned - Staff Only
    Route::put("/borrow", [borrowingsController::class, "markAsReturned"]);

    // Customer Management - Staff Only (Task 2)
    Route::apiResource("customer", "App\Http\Controllers\CustomerController")
        ->parameter("customer", "customer");

    Route::get("/borrow/all", [borrowingsController::class, "all"]);
    Route::get("/borrow/overdue", [borrowingsController::class, "overdue"]);

});

// Public Customer Login
Route::post("/customer/login", [CustomerAuthController::class, "login"]);
Route::post("/customer/register", [CustomerAuthController::class, "register"]);

// Protected Customer Routes
Route::middleware('auth:customers')->group(function () {

    Route::get("/customer-me", [CustomerAuthController::class, "me"]);
    Route::post("/customer-logout", [CustomerAuthController::class, "logout"]);

    // Borrowings Routes - Customers Only

    Route::post("/borrow", [borrowingsController::class, "borrow"]);
    Route::get("/borrow", [borrowingsController::class, "index"]);


});

// Reading Routes - Staff and Customers
Route::middleware('auth:sanctum')->group(function () {

    Route::get("/category", [CategoryController::class, "index"]);
    Route::get("/category/{category}", [CategoryController::class, "show"]);

    Route::get("/book/{book}", [BookController::class, "show"]);
    Route::get("/book", [BookController::class, "index"]);

});
