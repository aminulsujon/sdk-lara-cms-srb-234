<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitesettingController;
use App\Http\Controllers\SiteoptionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandecialController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PagesettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AreaController;

use Illuminate\Support\Facades\Route;

use App\Mail\TestWebmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Artisan;

Route::get('/cc', function () {

    
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');

    return 'cc.';
});

Route::get('/send-test-email', function () {
    Mail::to('aminul532sujon@gmail.com')->send(new TestWebmail());
    return 'Email sent!';
});


Route::get('/register', function () {
    return 'Please try again!!!';
});

Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/', [HomeController::class,'landing'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Route::get('/settings', [SitesettingController::class, 'index'])->name('settings');

Route::get('change-password', [ChangePasswordController::class,'index'])->name('change_password');
Route::post('change-password', [ChangePasswordController::class,'store'])->name('change.password');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [WelcomeController::class,'home'])->name('home');
    Route::prefix('admin')->group(function () {
        Route::resource('welcome', WelcomeController::class);
        Route::get('profile/edit', [UserController::class,'edit_admin_profile'])->name('edit_admin_profile');
        Route::post('profile/update/{id}', [UserController::class,'update_admin_profile'])->name('update_admin_profile');
        Route::resource('user', UserController::class);
        Route::post('user/search', [UserController::class,'search']);
        Route::resource('content', ContentController::class);
        Route::resource('page', PageController::class);
        Route::resource('blog', BlogController::class);
        Route::prefix('news')->group(function () {
            Route::get('rundown', [NewsController::class, 'rundown'])->name('admin.news.rundown');
            Route::get('rundown_remove/{id}', [NewsController::class, 'rundown_remove'])->name('admin.news.rundown_remove');
            Route::post('update-seq', [NewsController::class, 'updateSeq']);

        });
        Route::resource('news', NewsController::class);
        // Route::resource('rundown', NewsController::class);
        Route::resource('work', WorkController::class);
        Route::resource('tag', TagController::class);
        Route::resource('landing', LandingController::class);
        Route::resource('siteoption', SiteoptionController::class);
        Route::resource('landecial', LandecialController::class);
        Route::resource('pagesetting', PagesettingController::class);
        Route::resource('service', ServiceController::class);
        Route::resource('testimonial', TestimonialController::class);
        Route::resource('upload', UploadController::class);
        Route::post('upload/search', [UploadController::class,'search']);

        Route::resource('setting', SettingController::class);
        
        // specified route for create and manage landing pages generation
        Route::post('a/{slug}', [LandingController::class,'checkExistsPagelink']);
        Route::post('pagelinkediting/{slug}', [LandingController::class,'getEditPagelinkId']);
        
        // tag search
        Route::post('searchTag/{slug}', [TagController::class,'findByTitle']);
        Route::post('changestatus/{table}/{id}/{newstatus}', [CommentController::class,'changestatus']);
    });
});

// Area routes for AJAX
Route::get('/get-districts/{division}', [AreaController::class, 'getDistricts']);
Route::get('/get-upazilas/{district}', [AreaController::class, 'getUpazilas']);
Route::post('/ajax_cat_content', [HomeController::class, 'categoryContents'])->name('categoryContents');


// Search route
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::post('/areas', [HomeController::class, 'areas'])->name('areas');
Route::get('/areas', [HomeController::class, 'areasIndex'])->name('areasIndex');
Route::get('/archive/{date}', [HomeController::class, 'archive'])->name('archive');

Route::get('/{pagelink}', [HomeController::class,'landing']);

