<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::post('register',[AuthController::class,'register']);
 Route::post('login',[AuthController::class,'login']);

//Route::middleware('auth:sanctum')->group(function(){

    // Route::get('/checkingAuthenticated',function(){
    //     return response()->json(['message'=>'you are in','status'=>200],200);
    // });

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('products', [ProductController::class, 'store']);
Route::put('productsupdate/{id}', [ProductController::class, 'update']);
Route::delete('productdelete/{id}', [ProductController::class, 'destroy']);

Route::get('category', [CategoryController::class, 'index']);
Route::get('mobile', [ProductController::class, 'mobiles']);
Route::get('fashion', [ProductController::class, 'fashions']);
Route::get('appliance', [ProductController::class, 'appliances']);
Route::get('view_confirmorder', [CartController::class, 'view_confirmorder']);

Route::get('category/{id}', [CategoryController::class, 'show']);
Route::post('category', [CategoryController::class, 'store']);
Route::put('categoryupdate/{id}', [CategoryController::class, 'update']);
Route::delete('categorydelete/{id}', [CategoryController::class, 'destroy']);
Route::post('add_to_cart', [CartController::class, 'addtocart']);
Route::get('viewcart/{id}', [CartController::class, 'viewcart']);

Route::post('logout',[AuthController::class,'logout']);

Route::get('product_cart/{id}', [CartController::class, 'product_cart']);
Route::get('product_cart2/{id}', [CartController::class, 'product_cart2']);
Route::get('showcart/{id}', [CartController::class, 'show']);
Route::put('update_status/{id}', [CartController::class, 'update_status']);


// });
