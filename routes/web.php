<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

//お問い合わせフォーム用ルート
//Route::get('/contacts', [ContactFormController::class, 'index'])->name('contacts.index');
//Route::get('/contacts', [ContactFormController::class, 'get'])->name('contacts.index');
//リソースコントローラー用のまとめてルート作成
//middleware([auth])認証機能。認証されたユーザー(ログイン済み）いがいをはじく
// Route::resource('contacts', ContactFormController::class)->middleware(['auth']);

Route::prefix('contacts') // 頭に contacts をつける 
    ->middleware(['auth']) // 認証 
    ->name('contacts.') // ルート名 
    ->controller(ContactFormController::class) // コントローラ指定 
    ->group(function () { // グループ化 
        Route::get('/', 'index')->name('index'); // 名前つきルート
        Route::get('/create', 'create')->name('create'); // 名前つきルート
        Route::post('/', 'store')->name('store');
    });



//テスト用ルーティング
//ルートには名前を付けることができる。名前を付けておくと、リンクを張るときに便利。
Route::get('tests/test', [TestController::class, 'index'])->name('test.index');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
