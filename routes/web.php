<?php
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MicropostsController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\FavoriteController;
use Livewire\Volt\Volt;

/*Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');*/
Route::get('/', [MicropostsController::class, 'index'])->name('home');

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function (){
    Route::prefix('users/{id}')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');
    });

    Route::prefix('microposts/{id}')->group(function() {
        Route::post('favorites', [FavoriteController::class, 'store'])->name('favorites.favorite');
        Route::delete('unfavorite', [FavoriteController::class, 'destroy'])->name('favorites.unfavorite');
    });
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
    /*Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');*/
});

require __DIR__.'/auth.php';
