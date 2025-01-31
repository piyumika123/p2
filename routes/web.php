<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboards.manager');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/manager/dashboard', function () {
    return view('dashboards.manager');
})->middleware(['auth', 'verified'])->name('manager.dashboard');

Route::get('/warehouse/dashboard', function () {
    return view('dashboards.warehouse');
})->middleware(['auth', 'verified'])->name('warehouse.dashboard');

Route::get('/supermarket/dashboard', function () {
    return view('dashboards.supermarket');
})->middleware(['auth', 'verified'])->name('supermarket.dashboard');

Route::get('/supermarket/sale', function () {
    return view('auth.supermaket.sale');
})->middleware(['auth', 'verified'])->name('supermarket.sale');

Route::get('/supermarket/goods-inward', function () {
    return view('auth.supermaket.goods_inward');
})->middleware(['auth', 'verified'])->name('supermarket.goods_inward');

Route::get('/supermarket/goods-order', function () {
    return view('auth.supermaket.goods_order');
})->middleware(['auth', 'verified'])->name('supermarket.goods_order');

Route::get('/supermarket/goods-return', function () {
    return view('auth.supermaket.goods_return');
})->middleware(['auth', 'verified'])->name('supermarket.goods_return');

Route::get('/supermarket/live-stock', function () {
    return view('auth.supermaket.live_stock');
})->middleware(['auth', 'verified'])->name('supermarket.live_stock');

Route::get('/supermarket/wastage-stock', function () {
    return view('auth.supermaket.wastage_stock');
})->middleware(['auth', 'verified'])->name('supermarket.wastage_stock');

Route::get('/employee/create', function () {
    return view('auth.register');
})->middleware(['auth', 'verified'])->name('employee.create');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.user');

Route::get('/supplier/registration', function () {
    return view('auth.manger.suplyer_blade');
})->middleware(['auth', 'verified'])->name('supplier.registration');

Route::get('/item/registration', function () {
    return view('auth.manger.item_registration');
})->middleware(['auth', 'verified'])->name('item.registration');

Route::post('/item/register', [ItemController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('item.register');

Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');

Route::post('/supplier/register', [SupplierController::class, 'store'])->name('supplier.register');

Route::post('/stock/add', [StockController::class, 'add'])->name('stock.add');

Route::post('/goods/billing', [GoodsController::class, 'billing'])->name('goods.billing');
Route::post('/goods/order', [GoodsController::class, 'order'])->name('goods.order');
Route::post('/goods/return', [GoodsController::class, 'return'])->name('goods.return');
Route::post('/live/stock', [StockController::class, 'live'])->name('live.stock');
Route::post('/wastage/stock', [StockController::class, 'wastage'])->name('wastage.stock');

Route::post('/soup/add', [ItemController::class, 'addSoup'])->name('soup.add');

Route::post('/goods/inward', [GoodsController::class, 'inward'])->name('goods.inward');

Route::get('/goods/billing', function () {
    return view('auth.store.goods_billing');
})->name('goods.billing');

Route::get('/goods/order', function () {
    return view('auth.store.goods_order');
})->name('goods.order');

Route::get('/goods/return', function () {
    return view('auth.store.goods_return');
})->name('goods.return');

Route::get('/live/stock', function () {
    return view('auth.store.live_stock');
})->name('live.stock');

Route::get('/wastage/stock', function () {
    return view('auth.store.wastage_stock');
})->name('wastage.stock');

Route::get('/addstock', function () {
    return view('auth.store.addstock');
})->name('addstock');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
