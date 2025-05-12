<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GoodsBillingController;
use App\Http\Controllers\SupermarketController;
use App\Http\Controllers\GoodsController; // Add this line
use App\Http\Controllers\SupermarketStockController; // Correct the controller name

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

Route::get('/supermarket/sale', [App\Http\Controllers\SupermarketController::class, 'showSaleForm'])->name('supermarket.sale');

Route::get('/supermarket/goods-inward', [SupermarketStockController::class, 'goodsInward'])
    ->middleware(['auth', 'verified'])
    ->name('supermarket.goods_inward');

Route::get('/supermarket/goods-order', function () {
    return view('auth.supermaket.goods_order');
})->middleware(['auth', 'verified'])->name('supermarket.goods_order');

Route::get('/supermarket/goods-return', function () {
    return view('auth.supermaket.goods_return');
})->middleware(['auth', 'verified'])->name('supermarket.goods_return');

Route::get('/supermarket/live-stock', [SupermarketStockController::class, 'liveStock'])
    ->middleware(['auth', 'verified'])
    ->name('supermarket.live_stock');

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

// Ensure only POST method is defined for item registration
Route::post('/item/register', [ItemController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('item.register');

Route::get('/item/registration', function () {
    return view('auth.manger.item_registration');
})->middleware(['auth', 'verified'])->name('item.registration');

Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');

Route::post('/supplier/register', [SupplierController::class, 'store'])->name('supplier.register');

Route::post('/stock/add', [ItemController::class, 'add'])->name('stock.add');

Route::post('/goods/billing', [GoodsBillingController::class, 'store'])->name('goods.billing.store');
Route::post('/goods/order', [GoodsController::class, 'order'])->name('goods.order'); // Ensure this line is unique
Route::post('/goods/return', [GoodsController::class, 'return'])->name('goods.return');
Route::post('/live/stock', [ItemController::class, 'live'])->name('live.stock');
Route::post('/wastage/stock', [ItemController::class, 'wastage'])->name('wastage.stock');

Route::post('/soup/add', [ItemController::class, 'addSoup'])->name('soup.add');

Route::post('/goods/inward', [GoodsController::class, 'inward'])->name('goods.inward');

Route::get('/goods/billing', function () {
    return view('auth.store.goods_billing');
})->name('goods.billing');

Route::get('/goods/order', function () {
    return view('auth.store.goods_order');
})->name('goods.order'); // Ensure this line is unique
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

Route::get('/stock/add', function () {
    return view('auth.store.addstock');
})->middleware(['auth', 'verified'])->name('stock.add');

Route::post('/stock/add', [ItemController::class, 'add'])->name('stock.add');

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
    Route::post('/supermarket/stock/store', [SupermarketStockController::class, 'store'])->name('supermarket.stock.store');
    Route::get('/supermarket/goods_inward', [SupermarketStockController::class, 'goodsInward'])->name('supermarket.goods_inward');
});

Route::resource('stocks', ItemController::class);
Route::resource('suppliers', SupplierController::class);

Route::get('/test-item-register', function () {
    return response()->json(['message' => 'Item register route is working']);
})->middleware(['auth', 'verified']);

Route::post('/supplier/send-email', [SupplierController::class, 'sendEmail'])->name('supplier.send-email');

Route::get('/search-supplier', [SupplierController::class, 'searchSupplier']);

Route::get('/search-item', [ItemController::class, 'searchItem']);

Route::get('/goods-billing', [GoodsBillingController::class, 'index'])->name('goods.billing');
Route::post('/goods-billing', [GoodsBillingController::class, 'store'])->name('goods.billing.store');

// Add the missing route definition
Route::post('/supermarket/stock/store', [SupermarketStockController::class, 'store'])->name('supermarket.stock.store');
Route::get('/api/get-item-name', [App\Http\Controllers\SupermarketController::class, 'getItemName'])
    ->middleware(['auth', 'verified']); // Add middleware for security

Route::post('/supermarket/add-item', [SupermarketController::class, 'addItem'])->name('supermarket.addItem');

Route::post('/supermarket/print-bill', [SupermarketController::class, 'printBill'])->name('supermarket.printBill');

require __DIR__.'/auth.php';
