<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\SupportController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

// 3rd Party packages 

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\BlogPost;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminSupportController;

// Base Pages

Route::get('/', [PagesController::class, 'home']);
Route::get('/contact', [PagesController::class, 'contact']);
Route::get('/about', [PagesController::class, 'about']);


Route::resource('/blog', BlogController::class);

// Routes first protected by Auth

Route::middleware('auth')->group(function () {

    // Standard Routes that require login to access
    Route::resource('/profile', ProfileController::class);
    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::resource('support', SupportController::class);

    // Protect the Dashboard routes behind both Auth and Can
    Route::prefix('admin')->group(function () {
        Route::resource('/', AdminController::class)->middleware('can:Admin');
        Route::resource('/users', AdminUserController::class)->middleware('can:Admin');
        Route::resource('/blog', AdminBlogController::class)->middleware('can:Admin');
        Route::resource('/support', AdminSupportController::class)->middleware('can:Admin');
    });

    // Logout route to clear session.

    Route::get('/logout', function(){
        Session::flush();
        Auth::logout();
        return Redirect::to("/");
    });

});

// Sitemap by Spatie - Need to run generate-sitemap

Route::get('/generate-sitemap', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/blog'))
        ->add(Url::create('/contact'))
        ->add(Url::create('/about'));

    foreach (\App\Models\BlogPost::where('published', true)->get() as $post) {
        $sitemap->add(
            Url::create("/blog/{$post->slug}")
                ->setLastModificationDate($post->updated_at)
        );
    }

    $sitemap->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap generated!';
});

require __DIR__.'/auth.php';

