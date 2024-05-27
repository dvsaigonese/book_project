<?php

use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\GenreController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\NewsBEController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SatisticsController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\CouponController;

use App\Http\Controllers\Frontend\AllBooksController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DetailsController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\OrderFEController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CouponFEController;

use App\Http\Controllers\Frontend\GHNController;

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
Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

Route::get('/account', function () {
    return view('pages.account');
})->name('account');

//Book List Routes
Route::get('/books', [AllBooksController::class, 'index'])->name('books');
Route::post('/books', [AllBooksController::class, 'search'])->name('search');
Route::get('/books/genres/{genre_slug}', [AllBooksController::class, 'genreFilter'])->name('genre_filter');
Route::get('/books/authors/{author_slug}', [AllBooksController::class, 'authorFilter'])->name('author_filter');

//Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart-update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{book_id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart/quantity', [CartController::class, 'getQuantity'])->name('cart.getQuantity');

//Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{book_id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

//Review Routes
Route::get('/review/{book_slug}', [ReviewController::class, 'index'])->name('review');
Route::post('/review/{book_slug}', [ReviewController::class, 'store'])->name('review.store');

//Book Details Routes
Route::get('/details/{book_slug}', [DetailsController::class, 'show'])->name('details');

//News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::middleware('auth')->group(function () {
    //Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    //Coupon Routes
    Route::post('/coupons', [CouponFEController::class, 'addCoupon'])->name('coupon.add');
    Route::get('/coupons/remove', [CouponFEController::class, 'removeCoupon'])->name('coupon.remove');

    //Payment Routes
    Route::post('/vnpay-payment', [CheckoutController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::post('/vnpay-querydr', [CheckoutController::class, 'vnpay_querydr'])->name('vnpay_querydr');
    Route::post('/cash-on-delivery', [CheckoutController::class, 'cashOnDelivery'])->name('cash_on_delivery');

    //GHN Routes
    Route::get('/province', [GHNController::class, 'getProvince'])->name('ghn.province');
    Route::get('/district/{province_id}', [GHNController::class, 'getDistrict'])->name('ghn.district');
    Route::get('/ward/{district_id}', [GHNController::class, 'getWard'])->name('ghn.ward');
    Route::get('/shipping-cost', [GHNController::class, 'getShipCost'])->name('ghn.shipping');

    //Order Routes
    Route::get('/orders', [OrderFEController::class, 'index'])->name('order.index');
    Route::get('/orders/{status}', [OrderFEController::class, 'orderStatusFilter'])->name('order.statusFilter');
    Route::post('/orders/time', [OrderFEController::class, 'orderTimeFilter'])->name('order.timeFilter');
    Route::post('/orders', [CheckoutController::class, 'storeOrder'])->name('order.store');

});


Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        //Dashboard Routes
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        //Order Routes

        Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
        Route::put('/order/order_status/{id}', [OrderController::class, 'changeOrderStatus']);
        Route::put('/order/payment_status/{id}', [OrderController::class, 'changePaymentStatus']);

        //Book Routes
        Route::group(['middleware' => ['permission:create books|read books|update books|delete books']], function () {
            Route::get('/books', [BookController::class, 'index'])->name('admin.book.index');
            Route::get('/books/create', [BookController::class, 'create'])->name('admin.book.create');
            Route::post('/books', [BookController::class, 'store'])->name('admin.book.store');
            Route::get('/books/{id}', [BookController::class, 'edit'])->name('admin.book.edit');
            Route::put('/books/{id}', [BookController::class, 'update'])->name('admin.book.update');
            Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('admin.book.destroy');
            Route::get('books/{id}/add-author', [BookController::class, 'addAuthorView'])->name('admin.book.addAuthorView');
            Route::post('books/{book}/add-author/{author}', [BookController::class, 'addBookAuthor'])->name('admin.book.addBookAuthor');
            Route::delete('books/{book}/add-author/{author}', [BookController::class, 'deleteBookAuthor'])->name('admin.book.deleteBookAuthor');
            Route::get('books/{id}/add-genre', [BookController::class, 'addGenreView'])->name('admin.book.addGenreView');
            Route::post('books/{book}/add-genre/{genre}', [BookController::class, 'addBookGenre'])->name('admin.book.addBookGenre');
            Route::delete('books/{book}/add-genre/{genre}', [BookController::class, 'deleteBookGenre'])->name('admin.book.deleteBookGenre');
        });

        //Author Routes
        Route::group(['middleware' => ['permission:create authors|read authors|update authors|delete authors']], function () {
            Route::get('/authors', [AuthorController::class, 'index'])->name('admin.author.index');
            Route::get('/authors/create', [AuthorController::class, 'create'])->name('admin.author.create');
            Route::post('/authors', [AuthorController::class, 'store'])->name('admin.author.store');
            Route::get('/authors/{id}', [AuthorController::class, 'edit'])->name('admin.author.edit');
            Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('admin.author.update');
            Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('admin.author.destroy');
        });

        //Genre Routes
        Route::group(['middleware' => ['permission:create genres|read genres|update genres|delete genres']], function () {
            Route::get('/genres', [GenreController::class, 'index'])->name('admin.genre.index');
            Route::get('/genres/create', [GenreController::class, 'create'])->name('admin.genre.create');
            Route::post('/genres', [GenreController::class, 'store'])->name('admin.genre.store');
            Route::get('/genres/{id}', [GenreController::class, 'edit'])->name('admin.genre.edit');
            Route::put('/genres/{id}', [GenreController::class, 'update'])->name('admin.genre.update');
            Route::delete('/genres/{id}', [GenreController::class, 'destroy'])->name('admin.genre.destroy');
        });

        //User Routes
        Route::group(['middleware' => ['permission:create users|read users|update users|delete users']], function () {
            Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/users/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/users', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/users/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        });

        //News Routes
        Route::group(['middleware' => ['permission:create news|read news|update news|delete news']], function () {
            Route::get('/news', [NewsBEController::class, 'index'])->name('admin.news.index');
            Route::get('/news/create', [NewsBEController::class, 'create'])->name('admin.news.create');
            Route::post('/news', [NewsBEController::class, 'store'])->name('admin.news.store');
            Route::get('/news/{id}', [NewsBEController::class, 'edit'])->name('admin.news.edit');
            Route::put('/news/{id}', [NewsBEController::class, 'update'])->name('admin.news.update');
            Route::delete('/news/{id}', [NewsBEController::class, 'destroy'])->name('admin.news.destroy');
        });

        //Slider Routes
        Route::group(['middleware' => ['permission:create sliders|read sliders|update sliders|delete sliders']], function () {
            Route::get('/sliders', [SliderController::class, 'index'])->name('admin.slider.index');
            Route::get('/sliders/create', [SliderController::class, 'create'])->name('admin.slider.create');
            Route::post('/sliders', [SliderController::class, 'store'])->name('admin.slider.store');
            Route::get('/sliders/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit');
            Route::put('/sliders/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
            Route::put('/sliders/status/{id}', [SliderController::class, 'statusUpdate'])->name('admin.slider.status_update');
            Route::delete('/sliders/{id}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');
        });

        //Roles Routes
        Route::group(['middleware' => ['permission:create roles|read roles|update roles|delete roles']], function () {
            Route::get('/roles', [RoleController::class, 'index'])->name('admin.role.index');
            Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.role.create');
            Route::post('/roles', [RoleController::class, 'store'])->name('admin.role.store');
            Route::get('/roles/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
            Route::put('/roles/{id}', [RoleController::class, 'update'])->name('admin.role.update');
            Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');
        });

        //Coupon Routes
        Route::group(['middleware' => ['permission:create roles|read roles|update roles|delete roles']], function () {
            Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupon.index');
            Route::get('/coupons/create', [CouponController::class, 'create'])->name('admin.coupon.create');
            Route::post('/coupons', [CouponController::class, 'store'])->name('admin.coupon.store');
            Route::get('/coupons/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
            Route::put('/coupons/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
            Route::delete('/coupons/{id}', [CouponController::class, 'destroy'])->name('admin.coupon.destroy');
        });

        Route::group(['middleware' => ['permission:read statistics']], function () {
            Route::get('/satistics', [SatisticsController::class, 'index'])->name('admin.satistics.index');
            Route::get('/satistics/{option}', [SatisticsController::class, 'revenueStatistics'])->name('admin.satistics.revenueSatistics');
            Route::get('/satistics-time/{option}', [SatisticsController::class, 'timeStatistics'])->name('admin.satistics.timeSatistics');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('ckeditor/upload', [NewsBEController::class, 'upload'])->name('ckeditor.upload');


require __DIR__ . '/auth.php';

