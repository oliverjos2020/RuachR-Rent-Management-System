<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register/user', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');

Route::get('/signup', function (){
    return view('signup');
});
// Route::get('/signin', function () {
//     return view('signin');
// });

Route::get('/contact', function (){
    return view('contact');
});

Route::get('/register-illustrator', function (){
    return view('register-illustrator');
});

//ILLUSTRATOR
Route::post('/illustratore/store', [App\Http\Controllers\UserController::class, 'storeIllustrator'])->name('illustrator.store');
Route::get('/illustrator/{id}/single', [App\Http\Controllers\IllustratorController::class, 'single'])->name('illustrator.single');
Route::get('/illustrator', [App\Http\Controllers\IllustratorController::class, 'show'])->name('illustrator.product');


//SHOP
Route::get('/shop', [App\Http\Controllers\ProductController::class, 'show'])->name('show');
Route::get('/shop/{slug}', [App\Http\Controllers\ProductController::class, 'single'])->name('product.single');
Route::post('/shop/cart', [App\Http\Controllers\CartController::class, 'create'])->name('cart.create');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'fetch'])->name('cart.fetch');
Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cart}/destroy', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

//WISHLIST
Route::get('/wishlist/{wishlist}/add', [App\Http\Controllers\WishlistController::class, 'create'])->name('add.wishlist');
Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'read'])->name('view.wishlist');
Route::delete('/wishlist/{wishlist}/remove', [App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/migrate', [App\Http\Controllers\WishlistController::class, 'migrate'])->name('wishlist.migrate');


Route::get('/listing', [App\Http\Controllers\HomeController::class, 'listing'])->name('home.listing');
Route::get('/listing/{id}/property', [App\Http\Controllers\HomeController::class, 'view'])->name('home.single');
Route::get('/listing/{id}/sort', [App\Http\Controllers\HomeController::class, 'sort'])->name('home.sort');
Route::get('/location/{id}', [App\Http\Controllers\HomeController::class, 'location'])->name('home.location');


Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/{user}/profile', [App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard.profile');
Route::get('/dashboard/{user}/account', [App\Http\Controllers\DashboardController::class, 'account'])->name('dashboard.account');
Route::put('/dashboard/{user}/profile/update', [App\Http\Controllers\DashboardController::class, 'update'])->name('dashboard.profile.update');
Route::put('/dashboard/{user}/account/update', [App\Http\Controllers\DashboardController::class, 'change'])->name('illustrator.profile.update');

Route::get('/dashboard/{user}/biodata', [App\Http\Controllers\BiodataController::class, 'index'])->name('dashboard.biodata');
Route::post('/dashboard/biodata/store', [App\Http\Controllers\BiodataController::class, 'create'])->name('dashboard.biodata.store');
Route::get('/dashboard/{user}/biodata/edit', [App\Http\Controllers\BiodataController::class, 'edit'])->name('dashboard.biodata.edit');
Route::put('/dashboard/{biodata}/biodata/update', [App\Http\Controllers\BiodataController::class, 'update'])->name('dashboard.biodata.update');
//CATEGORY
Route::get('dashboard/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('dashboard.categories');
Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('dashboard.editcategory');
Route::put('/category/{category}/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('dashboard.category.update');
Route::delete('/category/{category}/destroy', [App\Http\Controllers\CategoryController::class, 'delete'])->name('dashboard.category.destroy');

//PRODUCTS
Route::get('/dashboard/create-product', [App\Http\Controllers\ProductController::class, 'create'])->name('dashboard.create-product');
Route::post('/dashboard/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('dashboard.product.store');
Route::get('/dashboard/all-products', [App\Http\Controllers\ProductController::class, 'dashboardShow'])->name('dashboard.all-products');
Route::get('/edit/{id}/product', [App\Http\Controllers\ProductController::class, 'edit'])->name('dashboard.edit-product');
Route::put('/dashboard/{id}/product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('dashboard.product.update');
Route::delete('/dashboard/{id}/product/destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->name('dashboard.product.destroy');
Route::get('/dashboard/illustrations', [App\Http\Controllers\ProductController::class, 'illustrations'])->name('dashboard.illustrations');


//ORDER
Route::post('/create/order', [App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
Route::any('/create/confirm', [App\Http\Controllers\OrderController::class, 'confirmPayment'])->name('order.confirm');
Route::get('/dashboard/order', [App\Http\Controllers\OrderController::class, 'fetch'])->name('dashboard.order');
Route::get('/my-order', [App\Http\Controllers\OrderController::class, 'myOrder'])->name('myorder');
Route::get('/fullfilled-order', [App\Http\Controllers\OrderController::class, 'fulfilledOrder'])->name('fullfilled.order');
Route::get('/update-fullfillment/{id}/{fulfillment}', [App\Http\Controllers\OrderController::class, 'updateFulfillment'])->name('fullfilled.update');
Route::get('/update/{reference}/account', [App\Http\Controllers\OrderController::class, 'updateAccount'])->name('update.account');



//CHAT
Route::post('/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
Route::post('/chat/fetch', [App\Http\Controllers\ChatController::class, 'fetch'])->name('chat.fetch');
Route::get('/dashboard/chat', [App\Http\Controllers\ChatController::class, 'chatPage'])->name('dashboard.chat');
Route::get('/chat/users', [App\Http\Controllers\ChatController::class, 'userList'])->name('chat.userList');

//CREATE PAYSTACK SUBACCOUNT
Route::post('/create/account', [App\Http\Controllers\AccountController::class, 'createSubAccount'])->name('create.subaccount');

//REVIEW
Route::post('/dashboard/review/store', [App\Http\Controllers\ReviewController::class, 'create'])->name('review.store');


//BANK ACCOUNT
Route::get('/bank-account', [App\Http\Controllers\DashboardController::class, 'accountBank'])->name('account');

});

Route::middleware(['role:Admin','auth'])->group(function(){

   

    Route::get('/dashboard/sales', [App\Http\Controllers\SaleController::class, 'index'])->name('dashboard.sales');
    Route::get('/dashboard/{sales}/remove', [App\Http\Controllers\SaleController::class, 'remove'])->name('dashboard.sales.remove');
    Route::get('/dashboard/{sales}/status', [App\Http\Controllers\SaleTimerController::class, 'status'])->name('dashboard.sales.status');
    Route::get('/account/{user_id}/{status}', [App\Http\Controllers\UserController::class, 'status'])->name('dashboard.status.account');
    Route::get('/verify/{user_id}/{status}', [App\Http\Controllers\UserController::class, 'verify'])->name('dashboard.status.verify');
    // Route::get('/dashboard/{sales}/sales/edit', [App\Http\Controllers\LocationController::class, 'edit'])->name('dashboard.editsales');
    // Route::put('/dashboard/{sales}/sales/update', [App\Http\Controllers\LocationController::class, 'update'])->name('dashboard.updatesales');
    // Route::delete('/dashboard/{sales}/sales/destroy', [App\Http\Controllers\LocationController::class, 'delete'])->name('dashboard.sales.destroy');
    Route::post('/dashboard/saletimer/create', [App\Http\Controllers\SaleTimerController::class, 'create'])->name('dashboard.saletimer.store');

 
    //Route::get('/dashboard/{user}/users', [App\Http\Controllers\UserController::class, 'edit'])->name('dashboard.edit');
    



 

    Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('dashboard.editrole');
    Route::put('/role/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('dashboard.role.update');
    Route::delete('/role/{role}/destroy', [App\Http\Controllers\RoleController::class, 'delete'])->name('dashboard.role.destroy');

});

Route::middleware(['role:Admin','auth'])->group(function(){
    Route::get('dashboard/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('dashboard.categories');
    Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('dashboard.editcategory');
    Route::put('/category/{category}/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('dashboard.category.update');
    Route::delete('/category/{category}/destroy', [App\Http\Controllers\CategoryController::class, 'delete'])->name('dashboard.category.destroy');

    Route::get('/dashboard/users', [App\Http\Controllers\UserController::class, 'show'])->name('dashboard.users');
    Route::get('/dashboard/illustrators', [App\Http\Controllers\UserController::class, 'illustrators'])->name('dashboard.illustrators');
    Route::put('/dashboard/{user}/role/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/dashboard/{user}/role/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');
    Route::get('/dashboard/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('dashboard.roles');
    Route::delete('/dashboard/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('dashboard.destroy');


    Route::get('/dashboard/create-property', [App\Http\Controllers\PropertyController::class, 'create'])->name('dashboard.create-property');
    Route::post('/dashboard/property/store', [App\Http\Controllers\PropertyController::class, 'store'])->name('dashboard.property.store');
    Route::get('/dashboard/manage-property', [App\Http\Controllers\PropertyController::class, 'show'])->name('dashboard.manage-property');
    Route::get('/dashboard/{id}/edit', [App\Http\Controllers\PropertyController::class, 'edit'])->name('dashboard.edit-property');
    Route::put('/dashboard/{id}/property/update', [App\Http\Controllers\PropertyController::class, 'update'])->name('dashboard.property.update');
    Route::delete('/dashboard/{id}/property/destroy', [App\Http\Controllers\PropertyController::class, 'destroy'])->name('dashboard.property.destroy');

    Route::get('/dashboard/location', [App\Http\Controllers\LocationController::class, 'index'])->name('dashboard.location');
    Route::post('/dashboard/location/store', [App\Http\Controllers\LocationController::class, 'store'])->name('dashboard.location.store');
    Route::get('/dashboard/{location}/location/edit', [App\Http\Controllers\LocationController::class, 'edit'])->name('dashboard.editlocation');
    Route::put('/dashboard/{location}/location/update', [App\Http\Controllers\LocationController::class, 'update'])->name('dashboard.updatelocation');
    Route::delete('/dashboard/{location}/location/destroy', [App\Http\Controllers\LocationController::class, 'delete'])->name('dashboard.location.destroy');

});


Route::middleware(['auth', 'can:view,user'])->group(function(){

    Route::get('/dashboard/{user}/profile', [App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard.profile');
});
