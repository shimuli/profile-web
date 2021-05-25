<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

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

// simply route

 $news = [
        1 => [
            'title' => 'Introduction to programming',
            'content' => "This is a new topic",
            'is_new' => true,
            'has_comment' => true,
        ],
        2 => [
            'title' => 'Php',
            'content' => "Something about php",
            'is_new' => false,
        ],
        3 => [
            'title' => 'Java',
            'content' => "Something about Java",
            'is_new' => true,
        ],
    ];

    // static controller
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class,'contact'])->name('home.contact');

//Routing for Article controller with resource
Route::resource('articles', ArticlesController::class);
Route::resource('about', AboutController::class);
Route::resource('resume', ResumeController::class);
Route::resource('services', ServicesController::class);
// ->only(['index], 'show'), 'create', 'store']);



// Route::get('/about', function () {
//     return view('home.about');
// })->name('home.about');

// Route::get('/resume', function () {
//     return view('home.resume');
// })->name('home.contact');

// Route::get('/services', function () {
//     return view('home.services');
// })->name('home.services');

//dummy data


// Route::get('/blogs', function () use ($news) {
//     return view('articles.index', ['articles' => $news]);
// });

// Route::get('/blog/{id}', function ($id) use ($news) {
//     abort_if(!isset($news[$id]), 404);
//     return view('articles.show', ['article' => $news[$id]]);

// })->name('articles.show');

// routes with default id
Route::get('recent-articles/{days_ago?}', function ($daysAgo = 23) {
    return 'Post from ' . $daysAgo . ' days ago';
})
->name('articles.recent.index');
//  ->middleware('auth');


// Route grouping
Route::prefix('/fun')->name('fun.')->group(function () use ($news) {
    // response codes
    Route::get('/responses', function () use ($news) {
        return response($news, 201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE', 'cedric', 3600);
    })->name('responses');

// redirect response
    Route::get('/redirect', function () {
        return redirect('/contact');
    })->name('redirect');

// redirect to last address
    Route::get('/back', function () {
        return back();
    })->name('back');

// redirect to named route
    Route::get('/named-route', function () {
        return redirect()->route('articles.show', ['id' => 1]);
    })
    ->name('named-route');

// redirect away from website
    Route::get('/away', function () {
        return redirect()->away('https://google.com');
    })->name('away');

// json data
    Route::get('/json', function () use ($news) {
        return response()->json($news);
    })->name('json');

// force download
    Route::get('/download', function () use ($news) {
        return response()->download(public_path('/shimulicedric.pdf'), 'Cedric Resume.pdf');
    })->name('download');
});


