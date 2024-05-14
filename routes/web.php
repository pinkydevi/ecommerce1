<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\PredictionController;
use App\Http\Controllers\Auth\LoginController;

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


// Authentication routes
Auth::routes();

// Frontend routes
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/register', [IndexController::class, 'register'])->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');

Route::get('/frontend/product', function () {
    return view('frontend.product.product_details');
});

// Home and logout routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [HomeController::class, 'logout'])->name('customer.logout');

// You can continue adding other routes like the previous ones you provided.

// Frontend routes
Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/product-details/{slug}', [IndexController::class, 'ProductDetails'])->name('product.details');
    Route::get('/product-quick-view/{id}', [IndexController::class, 'ProductQuickView']);

    // Cart
    Route::get('/all-cart', [CartController::class, 'AllCart'])->name('all.cart');
    Route::get('/my-cart', [CartController::class, 'MyCart'])->name('cart');
    Route::get('/cart/empty', [CartController::class, 'EmptyCart'])->name('cart.empty');
    Route::get('/checkout', [CheckoutController::class, 'Checkout'])->name('checkout');
    Route::post('/apply/coupon', [CheckoutController::class, 'ApplyCoupon'])->name('apply.coupon');
    Route::get('/remove/coupon', [CheckoutController::class, 'RemoveCoupon'])->name('coupon.remove');
    Route::post('/order/place', [CheckoutController::class, 'OrderPlace'])->name('order.place');
    Route::post('/addtocart', [CartController::class, 'AddToCartQV'])->name('add.to.cart.quickview');
    Route::get('/cartproduct/remove/{rowId}', [CartController::class, 'RemoveProduct']);
    Route::get('/cartproduct/updateqty/{rowId}/{qty}', [CartController::class, 'UpdateQty']);
    Route::get('/cartproduct/updatecolor/{rowId}/{color}', [CartController::class, 'UpdateColor']);
    Route::get('/cartproduct/updatesize/{rowId}/{size}', [CartController::class, 'UpdateSize']);

    // Wishlist
    Route::get('/wishlist', [CartController::class, 'wishlist'])->name('wishlist');
    Route::get('/clear/wishlist', [CartController::class, 'Clearwishlist'])->name('clear.wishlist');
    Route::get('/add/wishlist/{id}', [CartController::class, 'AddWishlist'])->name('add.wishlist');
    Route::get('/wishlist/product/delete/{id}', [CartController::class, 'WishlistProductdelete'])->name('wishlistproduct.delete');

    // Category-wise product
    Route::get('/category/product/{id}', [IndexController::class, 'categoryWiseProduct'])->name('categorywise.product');
    Route::get('/subcategory/product/{id}', [IndexController::class, 'SubcategoryWiseProduct'])->name('subcategorywise.product');
    Route::get('/childcategory/product/{id}', [IndexController::class, 'ChildcategoryWiseProduct'])->name('childcategorywise.product');
    Route::get('/brandwise/product/{id}', [IndexController::class, 'BrandWiseProduct'])->name('brandwise.product');

    // Profile setting
    Route::get('/home/setting', [ProfileController::class, 'setting'])->name('customer.setting');
    Route::post('/home/password/update', [ProfileController::class, 'PasswordChange'])->name('customer.password.change');
    Route::get('/my/order', [ProfileController::class, 'MyOrder'])->name('my.order');
    Route::get('/view/order/{id}', [ProfileController::class, 'ViewOrder'])->name('view.order');

    // Review
    Route::post('/store/review', [ReviewController::class, 'store'])->name('store.review');
    Route::get('/write/review', [ReviewController::class, 'write'])->name('write.review');
    Route::post('/store/website/review', [ReviewController::class, 'StoreWebsiteReview'])->name('store.website.review');

   //page view
    Route::get('/page/{page_slug}', [IndexController::class, 'ViewPage'])->name('view.page');
    
    //newsletter
    Route::post('/store/newsletter', [IndexController::class, 'storeNewsletter'])->name('store.newsletter');
    
    //support ticket
    Route::get('/open/ticket', [ProfileController::class, 'ticket'])->name('open.ticket');
    Route::get('/new/ticket', [ProfileController::class, 'NewTicket'])->name('new.ticket');
    Route::post('/store/ticket', [ProfileController::class, 'StoreTicket'])->name('store.ticket');
    Route::get('/show/ticket/{id}', [ProfileController::class, 'ticketShow'])->name('show.ticket');
    Route::post('/reply/ticket', [ProfileController::class, 'ReplyTicket'])->name('reply.ticket');

    //order tracking
    Route::get('/order/tracking', [IndexController::class, 'OrderTracking'])->name('order.tracking');
    Route::post('/check/order', [IndexController::class, 'CheckOrder'])->name('check.order');
    
    //__payment gateway
    Route::post('/success', [CheckoutController::class, 'success'])->name('success');
    Route::post('/fail', [CheckoutController::class, 'fail'])->name('fail');
    Route::get('/success', function () {
        return redirect()->to('/');
    })->name('cancel');

 
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');

    Route::get('/our-blog', [IndexController::class, 'Blog'])->name('blog');
    
    //__campaign__//
    Route::get('/campain/products/{id}', [IndexController::class, 'CampaignProduct'])->name('frontend.campaign.product');
    Route::get('/camapign-product-details/{slug}', [IndexController::class, 'CampaignProductDetails'])->name('campaign.product.details');
});

// Socialite Routes
Route::get('oauth/{driver}', [LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
Route::get('/contact-us', [IndexController::class, 'Contact'])->name('contact');
Route::post('/contact/submit', [IndexController::class, 'submitContactForm'])->name('contactme.submite');

// search Routes
Route::get('/search', [SearchController::class, 'search'])->name('search');



Route::get('/emotion', function () {
    return view('emotion');
});
Route::post('/predict-emotion', [PredictionController::class, 'predictEmotion'])->name('predict.emotion');