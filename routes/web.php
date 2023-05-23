<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;

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

Route::get('/', [ProjectController::class,'index'])->name('index');


// Route:: get('/home',function(){

//     return view('index');
    
//     });
// Route:: get('/home',[ProjectController::class,'index'])->name('index');
Route:: get('/testimonial',function(){

        return view('layout.testimonial');
        
        });
    
Route:: get('/about',function(){

            return view('layout.about');
            
            });
        
 Route:: get('/login',function(){

                return view('layout.login');
                
                });
            
 Route:: get('/contact',function(){

                    return view('layout.contact');
                    
                    });
                
Route:: get('/single_product',function(){

return view('single_products');

});

Route:: get('/products',[ProjectController::class,'products'])->name('products');
Route:: get('/product/details/{id}',[ProjectController::class,'productDetails'])->name('product_details');


Route:: get('/about',function(){

    return view('about');
    
    });

    Route::get('/uploadfile', 'App\Http\Controllers\UploadfileController@index');
    Route::post('/uploadfile', 'App\Http\Controllers\UploadfileController@upload');
    Route::get('/main', 'App\Http\Controllers\MainController@index');
    Route::post('/main/checklogin', 'App\Http\Controllers\MainController@checklogin')->name('main.checklogin');
    Route::get('main/successlogin', 'App\Http\Controllers\MainController@successlogin');
    Route::get('main/logout', 'App\Http\Controllers\MainController@logout');
    
    Route::get('user/registration', 'App\Http\Controllers\MainController@userRegistration')->name('user.registration');
    Route::post('save/registration', 'App\Http\Controllers\MainController@saveRegistration')->name('save.registration');

    
Route:: get('/single_product/{id}', [ProjectController::class, 'single_product'])->name('single_product');  

Route:: get('/cart', [CartController::class, 'cart'])->name('cart'); 



Route::post('/plus_cart_item', [CartController::class, 'plus_cart_item' ])-> name('plus_cart_item');
Route::post('/minus_cart_item', [CartController::class, 'minus_cart_item' ])-> name('minus_cart_item');
// Route::post('/add_to_cart', [CartController::class, 'add_to_cart' ])-> name('add_to_cart');
Route::get('/add_to_cart/{id}', [CartController::class, 'add_to_cart' ])-> name('add_to_cart');
// Route:: get('/add_to_cart', function(){

//     return redirect('/');

// });


Route::post('/remove_from_cart', [CartController::class, 'remove_from_cart' ])-> name('remove_from_cart');
Route:: get('/remove_from_cart', function(){

    return redirect('/');

});


Route::post('/edit_product_quantity', [CartController::class, 'edit_product_quantity' ])-> name('edit_product_quantity');
Route:: get('/edit_product_quantity', function(){

    return redirect('/');

});


Route::post('/checkout', [CartController::class, 'checkout' ])-> name('checkout');


Route::post('/place_order',[CartController::class, 'place_order'])->name('place.order');

Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');



Route::get('/success',function(){

    return view('layout.success');
    
    })->name('layout.success');

    // Route:: get('/home',function(){

    //     return view('index');
        
    //     })->name('layout.home');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::group(['prefix' => 'admin', 'namespace' => '\App\Http\Controllers\Admin'], function () {
    Route::get('/', 'AdminController@adminLogin')->name('admin.login');
    Route::post('/loginCheck', 'AdminController@adminLoginCheck')->name('admin.loginCheck');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', 'AdminController@adminDashboard')->name('admin.dashboard');
        Route::post('/admin/logout', 'AdminController@adminLogout')->name('admin.logout');
        Route::resource('category', 'CategoryController');
        Route::post('/get_categories', 'CategoryController@getCategories');
        Route::resource('product', 'ProductController');
        Route::post('/get_products', 'ProductController@getProducts');
    });
});
