<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\productController;
use App\Http\Controllers\merchantController;
use App\Http\Controllers\paymentController;
use App\Http\Middleware\EnsureUserIsAuthenticated;



Route::get('/login', [authController::class, 'getLogin']);    
Route::post('/login/user/post', [authController::class, 'postLogin']);    
Route::get('/register', [authController::class, 'getRegister']);
Route::post('/register/post', [authController::class, 'postRegister']);
Route::get('/admin/merchant/login', [merchantController::class, 'getLogin']);
Route::post('/admin/merchant/login/post', [authController::class, 'postLogin']);

Route::middleware([EnsureUserIsAuthenticated::class])->group(function () {
    Route::get('/', [homeController::class, 'getHome']);
    Route::get('/transaction/inprogres', [transactionController::class, 'getAllTrx']);

    Route::get('/event', [eventController::class, 'getEvent']);
    Route::get('/event/{id_event}', [eventController::class, 'getRegistEvent']);
    Route::post('/event/{id_event}/register/post', [eventController::class, 'postRegistEvent']);

    Route::get('/merchant/all', [productController::class, 'getAllMerchant']);
    Route::get('/merchant/{id_merchant}', [productController::class, 'getDetailMerchant']);
    Route::get('/product/{id_product}', [productController::class, 'getDetailProduct']);

    Route::get('/admin/merchant/order/all', [merchantController::class, 'getAllOrder']);
    Route::get('/admin/merchant/setting', [merchantController::class, 'getMerchantDashboard']);
    Route::post('/admin/merchant/logout', [MerchantController::class, 'logout'])->name('logout');

    Route::get('/admin/merchant/add/branch', [merchantController::class, 'getAddMerchant']);
    Route::post('/admin/merchant/add/branch/post', [merchantController::class, 'postAddMerchant']);

    Route::get('/admin/merchant/product/all/{id_merchant}', [merchantController::class, 'getProductList']);
    Route::get('/admin/merchant/product/add/{id_merchant}', [merchantController::class, 'getAddProduct']);

    Route::get('/admin/merchant/article', [merchantController::class, 'getListarticle']);
    Route::get('/admin/merchant/article/add', [merchantController::class, 'getAddArticle']);
    Route::post('/admin/merchant/article/add/post', [merchantController::class, 'postAddArticle']);
    Route::get('/admin/merchant/article/{id_article}', [merchantController::class, 'getEditArticle']);
    Route::post('/admin/merchant/article/edit/{id_article}/post', [merchantController::class, 'postEditArticle']);
    Route::post('/admin/merchant/article/delete/{id_article}', [merchantController::class, 'deleteArticle']);

    Route::post('/admin/merchant/product/add/{id_merchant}/post', [merchantController::class, 'postAddProduct']);

    Route::get('/admin/merchant/add/coin', [paymentController::class, 'getTopUpCoin']);
    Route::post('/admin/merchant/add/coin/post', [paymentController::class, 'postTopUpCoin']);

    Route::get('/admin/merchant/event', [merchantController::class, 'getListEvent']);
    Route::get('/admin/merchant/event/add', [merchantController::class, 'getAddEvent']);
    Route::get('/admin/merchant/event/edit/{id_event}', [merchantController::class, 'getEditEvent']);
    Route::post('/admin/merchant/event/edit/{id_event}/post', [merchantController::class, 'postEditEvent']);
    Route::post('/admin/merchant/event/delete/{id_event}', [merchantController::class, 'deleteEvent']);
    Route::post('/admin/merchant/event/add/post', [merchantController::class, 'postAddEvent']);

    Route::post('/cart/product/{id_product}', [productController::class, 'postAddCart']);
    Route::get('/checkout/{id_user}', [productController::class, 'getCheckout']);
    Route::post('/checkout/{id_user}/post', [paymentController::class, 'postCartCheckout']);

    Route::get('/payment/{id_user}', [paymentController::class, 'showSnap']);
    Route::post('/update-transaction', [paymentController::class, 'updateTransaction']);
});
