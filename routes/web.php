<?php

use App\Http\Controllers\Backend\Admin\AdminContoller;
use App\Http\Controllers\Backend\Auth\AssignRoleToUserController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\RoleController;
use App\Http\Controllers\Backend\Auth\UserController;
use App\Http\Controllers\Backend\Order\OrderContoller;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ProductContoller;
use App\Http\Controllers\Backend\Product\SubCategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController as FrontendLoginController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/dashboard', function () {
//     $user = Auth::user(); // Get the currently authenticated user
//     return view('admin.dashboard', ['user' => $user]);
// })->name('dashboard');

Route::get('/dashboard', [AdminContoller::class, "admin_dashboard"])->name('dashboard');
Route::get('/sample', function () {
    return view('admin.Role Management.sample');
});
// Route::get('/', [LoginController::class, "index"])->name('login.index');
Route::get('/', [HomeController::class, "index"])->name('home.index');
Route::get('/products/{product}', [HomeController::class, "show_single_product"])->name('frontend_product.show');
Route::post('/add-to-cart', [HomeController::class, "addToCart"])->name('cart.add');
Route::get('/show_cart', [HomeController::class, "show_Cart"])->name('show_cart.add');
Route::get('/show_cart_remove/{id}', [HomeController::class, "show_Cart_remove"])->name('show_cart.remove');
Route::get('/cash_on_delivery', [HomeController::class, "cash_on_delivery"])->name('cash_on_delivery');
Route::get('/stripe/{totalPrice}', [HomeController::class, "stripe"])->name('stripe');
Route::post('stripe/{totalPrice}', [HomeController::class, "stripePost"])->name('stripe.post');
// order
Route::get('show_order', [HomeController::class, "show_order"])->name('show_order.index');
Route::get('cancel_order/{id}', [HomeController::class, "cancel_order"])->name('cancel_order.index');

//comment
Route::post('add_comment', [HomeController::class, "add_comment"])->name('add_comment.post');
Route::post('add_reply', [HomeController::class, "add_reply"])->name('add_reply.post');

// search
Route::get('product_search', [HomeController::class, "product_search"])->name('product.search');
// Product
Route::get('products', [HomeController::class, "products"])->name('all_product.index');
Route::get('search_product', [HomeController::class, "search_product"])->name('search.product');
// Frontend login
Route::prefix('frontend')->group(function () {
    Route::get('/login', [FrontendLoginController::class, "index"])->name('frontend_login.index')->middleware('guest');
    Route::post('/login', [FrontendLoginController::class, "postLogin"])->name('frontend_login.login');
    Route::get('/register', [FrontendLoginController::class, "register"])->name('frontend_register.index');
    Route::post('/register', [FrontendLoginController::class, "store"])->name('frontend_register.create');
    Route::get('/logout', [FrontendLoginController::class, 'logout'])->name('frontend_login.logout');
});



// admin login
Route::prefix('admin')->group(function () {
    Route::get('/login_page', [LoginController::class, "index"])->name('login.index');
    Route::post('/login', [LoginController::class, "postLogin"])->name('postLogin');

    // Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    // Route::post('/login-validate', [LoginController::class, 'postLogin'])->name('admin.login-validate');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');


    Route::get('/forgot', function () {
        return view('auth.passwords.forgot_password');
    });
    Route::get('/reset', function () {
        return view('auth.passwords.reset_password');
    });
});

// Route::post('/login', [LoginController::class, "postLogin"])->name('postLogin');


Route::middleware(['auth', 'role:Admin'])->group(function () {
    // User register
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');

    // Role Management
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');

    // Assign Role To User
    Route::get('/assign_role', [AssignRoleToUserController::class, 'index'])->name('assign_role.index');
    Route::get('assign_role/create', [AssignRoleToUserController::class, 'create'])->name('assign_role.create');
    Route::post('assign_role/store', [AssignRoleToUserController::class, 'store'])->name('assign_role.store');
    // sample
    Route::get('assign_role/edit/{id}', [AssignRoleToUserController::class, 'edit'])->name('assign_role.edit');
    Route::post('assign_role/update/{id}', [AssignRoleToUserController::class, 'update'])->name('assign_role.update');
    Route::get('assign_role/delete/{id}', [AssignRoleToUserController::class, 'delete'])->name('assign_role.delete');

    // Product Management
    // category
    Route::prefix('category')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit_page'])->name('category.edit_page');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });


    // sub Category
    Route::prefix('sub_category')->group(function () {
        Route::get('/index', [SubCategoryController::class, 'index'])->name('sub_category.index');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('sub_category.create');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('sub_category.store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit_page'])->name('sub_category.edit_page');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('sub_category.update');
        // Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/index', [ProductContoller::class, 'index'])->name('product.index');
        Route::get('/create', [ProductContoller::class, 'create'])->name('product.create');
        Route::post('/store', [ProductContoller::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductContoller::class, 'edit_page'])->name('product.edit_page');
        Route::post('/update/{id}', [ProductContoller::class, 'update'])->name('product.update');
        Route::get('/delete/{id}', [ProductContoller::class, 'delete'])->name('product.delete');
    });
    Route::prefix('order')->group(function () {
        Route::get('/index', [OrderContoller::class, 'index'])->name('order.index');
        Route::get('/delivered/{id}', [OrderContoller::class, 'delivered'])->name('delivered.index');
        Route::get('/print_pdf/{id}', [OrderContoller::class, 'print_pdf'])->name('print_pdf.index');
        Route::get('/send_mail/{id}', [OrderContoller::class, 'send_mail'])->name('send_mail.index');
        Route::post('/send_email_user/{id}', [OrderContoller::class, 'send_email_user'])->name('send_email.user');
        Route::get('/search', [OrderContoller::class, 'search_data'])->name('search_data.index');
    });
});
