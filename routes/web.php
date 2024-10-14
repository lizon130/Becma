<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\backend\EventController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\backend\memberController;
use App\Http\Controllers\backend\NoticeController;
use App\Http\Controllers\backend\PartnerController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\AdminMailController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ExecutiveController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\backend\NewsBannerController;
use App\Http\Controllers\backend\ActiveMembersController;
use App\Http\Controllers\backend\gallery\PhotoController;
use App\Http\Controllers\backend\gallery\videoController;
use App\Http\Controllers\backend\RejectMembersController;
use App\Http\Controllers\backend\AdminComplaintController;
use App\Http\Controllers\backend\AdvisoryCommitteeController;
use App\Http\Controllers\backend\FundersCommitteeController;
use App\Http\Controllers\backend\PaymentController;
use App\Http\Controllers\backend\PreviousCommitteeController;
use App\Http\Controllers\backend\RunningCommitteeController;
use App\Http\Controllers\backend\SellerComplaintController;

Route::get('/', function () {
    return view('frontend.pages.home');
});

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('frontend.index');

    // service
    Route::get('/all-Service', 'allService')->name('frontend.service.all');
    Route::get('/Service-details/{id}', 'serviceDetails')->name('frontend.service.details');

    //news
    Route::get('/all-news', 'allNews')->name('frontend.news.all');
    Route::get('/news-details/{id}', 'newsDetails')->name('frontend.news.details');

    //news
    Route::get('/all-blogs', 'allblogs')->name('frontend.blog.all');
    Route::get('/blog-details/{id}', 'blogDetails')->name('frontend.blog.details');
});


// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/registration', 'registerForm')->name('frontend.registration');
    Route::post('/registration', 'register')->name('register');
    Route::get('/login', 'loginForm')->name('frontend.login');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});






// .....................................backend.........................................

Route::prefix('admin/')->controller(DashboardController::class)->middleware(['auth', 'role:admin|seller'])->group(function () {
    Route::get('dashboard', 'index')->name('admin.dashboard');
    Route::get('dashboard-all-members/list',  'getUsers')->name('dashboard.list');
});

Route::prefix('admin/')->controller(LoginController::class)->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('profile', 'adminProfile')->name('admin.profile');
    Route::post('profile/update', 'adminProfileUpdate')->name('admin.profile.update');
    Route::get('profile/setting', 'adminProfileSetting')->name('admin.profile.setting');
    Route::post('profile/change/password', 'adminChangePassword')->name('admin.change.password');

});

Route::prefix('admin/')->controller(memberController::class)->middleware(['auth', 'role:admin'])->group(function () {
    // Pending member
    Route::get('/pending-members',  'index')->name('users.index');
    Route::post('/pending-members',  'store')->name('users.store');
    Route::get('/pending-members/list',  'getUsers')->name('users.list');
    Route::get('/pending-members/{id}/edit',  'edit')->name('users.edit');
    Route::delete('/pending-members/{id}',  'destroy')->name('users.destroy');
});

Route::prefix('admin/')->controller(ActiveMembersController::class)->middleware(['auth', 'role:admin'])->group(function () {
    // Pending member
    Route::get('/active-members',  'index')->name('users.active.index');
    Route::post('/active-members',  'store')->name('users.active.store');
    Route::get('/active-members/list',  'getUsers')->name('users.active.list');
    Route::get('/active-members/{id}/edit',  'edit')->name('users.active.edit');
    Route::delete('/active-members/{id}',  'destroy')->name('users.active.destroy');
});

Route::prefix('admin/')->controller(RejectMembersController::class)->middleware(['auth', 'role:admin'])->group(function () {
    // Pending member
    Route::get('/reject-members',  'index')->name('users.reject.index');
    Route::post('/reject-members',  'store')->name('users.reject.store');
    Route::get('/reject-members/list',  'getUsers')->name('users.reject.list');
    Route::get('/reject-members/{id}/edit',  'edit')->name('users.reject.edit');
    Route::delete('/reject-members/{id}',  'destroy')->name('users.reject.destroy');
});

Route::prefix('admin/service')->controller(ServiceController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('service.index');
    Route::get('/list',  'getList')->name('service.list');
    Route::get('/create',  'create')->name('service.create');
    Route::post('/store',  'store')->name('service.store');
    Route::get('/edit',  'edit')->name('service.edit');
    Route::post('/update',  'update')->name('service.update');
    Route::post('/delete',  'delete')->name('service.delete');
});

Route::prefix('admin/event')->controller(EventController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('event.index');
    Route::get('/list',  'getList')->name('event.list');
    Route::get('/create',  'create')->name('event.create');
    Route::post('/store',  'store')->name('event.store');
    Route::get('/edit',  'edit')->name('event.edit');
    Route::post('/update',  'update')->name('event.update');
    Route::post('/delete',  'delete')->name('event.delete');
});

Route::prefix('admin/blog')->controller(BlogController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('blog.index');
    Route::get('/list',  'getList')->name('blog.list');
    Route::get('/create',  'create')->name('blog.create');
    Route::post('/store',  'store')->name('blog.store');
    Route::get('/edit',  'edit')->name('blog.edit');
    Route::post('/update',  'update')->name('blog.update');
    Route::post('/delete',  'delete')->name('blog.delete');
});

// ............................................................... Committee ....................................................................... //

Route::prefix('admin/executive-commitee')->controller(ExecutiveController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('commitee.index');
    Route::get('/list',  'getList')->name('commitee.list');
    Route::get('/create',  'create')->name('commitee.create');
    Route::post('/store',  'store')->name('commitee.store');
    Route::get('/edit',  'edit')->name('commitee.edit');
    Route::post('/update',  'update')->name('commitee.update');
    Route::post('/delete',  'delete')->name('commitee.delete');
});

Route::prefix('admin/running-commitee')->controller(RunningCommitteeController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('commitee.running.index');
    Route::get('/list',  'getList')->name('commitee.running.list');
    Route::get('/create',  'create')->name('commitee.running.create');
    Route::post('/store',  'store')->name('commitee.running.store');
    Route::get('/edit',  'edit')->name('commitee.running.edit');
    Route::post('/update',  'update')->name('commitee.running.update');
    Route::post('/delete',  'delete')->name('commitee.running.delete');
});

Route::prefix('admin/funders-commitee')->controller(FundersCommitteeController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('commitee.funders.index');
    Route::get('/list',  'getList')->name('commitee.funders.list');
    Route::get('/create',  'create')->name('commitee.funders.create');
    Route::post('/store',  'store')->name('commitee.funders.store');
    Route::get('/edit',  'edit')->name('commitee.funders.edit');
    Route::post('/update',  'update')->name('commitee.funders.update');
    Route::post('/delete',  'delete')->name('commitee.funders.delete');
});

Route::prefix('admin/advisory-commitee')->controller(AdvisoryCommitteeController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('commitee.advisory.index');
    Route::get('/list',  'getList')->name('commitee.advisory.list');
    Route::get('/create',  'create')->name('commitee.advisory.create');
    Route::post('/store',  'store')->name('commitee.advisory.store');
    Route::get('/edit',  'edit')->name('commitee.advisory.edit');
    Route::post('/update',  'update')->name('commitee.advisory.update');
    Route::post('/delete',  'delete')->name('commitee.advisory.delete');
});

Route::prefix('admin/previous-commitee')->controller(PreviousCommitteeController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('commitee.previous.index');
    Route::get('/list',  'getList')->name('commitee.previous.list');
    Route::get('/create',  'create')->name('commitee.previous.create');
    Route::post('/store',  'store')->name('commitee.previous.store');
    Route::get('/edit',  'edit')->name('commitee.previous.edit');
    Route::post('/update',  'update')->name('commitee.previous.update');
    Route::post('/delete',  'delete')->name('commitee.previous.delete');
});

// ............................................................... Committee ....................................................................... //

Route::prefix('admin/partner')->controller(PartnerController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('partner.index');
    Route::get('/list',  'getList')->name('partner.list');
    Route::get('/create',  'create')->name('partner.create');
    Route::post('/store',  'store')->name('partner.store');
    Route::get('/edit',  'edit')->name('partner.edit');
    Route::post('/update',  'update')->name('partner.update');
    Route::post('/delete',  'delete')->name('partner.delete');
});

Route::prefix('admin/photo-gallery')->controller(PhotoController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('gallery.photo.index');
    Route::get('/list',  'getList')->name('gallery.photo.list');
    Route::get('/create',  'create')->name('gallery.photo.create');
    Route::post('/store',  'store')->name('gallery.photo.store');
    Route::get('/edit',  'edit')->name('gallery.photo.edit');
    Route::post('/update',  'update')->name('gallery.photo.update');
    Route::post('/delete',  'delete')->name('gallery.photo.delete');
});

Route::prefix('admin/video-gallery')->controller(videoController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('gallery.video.index');
    Route::get('/list',  'getList')->name('gallery.video.list');
    Route::get('/create',  'create')->name('gallery.video.create');
    Route::post('/store',  'store')->name('gallery.video.store');
    Route::get('/edit',  'edit')->name('gallery.video.edit');
    Route::post('/update',  'update')->name('gallery.video.update');
    Route::post('/delete',  'delete')->name('gallery.video.delete');
});

Route::prefix('admin/news')->controller(NewsController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('news.index');
    Route::get('/list',  'getList')->name('news.list');
    Route::get('/create',  'create')->name('news.create');
    Route::post('/store',  'store')->name('news.store');
    Route::get('/edit',  'edit')->name('news.edit');
    Route::post('/update',  'update')->name('news.update');
    Route::post('/delete',  'delete')->name('news.delete');
});

Route::prefix('admin/news/banner')->controller(NewsBannerController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('news.banner.index');
    Route::get('/list',  'getList')->name('news.banner.list');
    Route::get('/create',  'create')->name('news.banner.create');
    Route::post('/store',  'store')->name('news.banner.store');
    Route::get('/edit',  'edit')->name('news.banner.edit');
    Route::post('/update',  'update')->name('news.banner.update');
    Route::post('/delete',  'delete')->name('news.banner.delete');
});

Route::prefix('admin/notice')->controller(NoticeController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'index')->name('notice.index');
    Route::get('/list',  'getList')->name('notice.list');
    Route::get('/create',  'create')->name('notice.create');
    Route::post('/store',  'store')->name('notice.store');
    Route::get('/edit',  'edit')->name('notice.edit');
    Route::post('/update',  'update')->name('notice.update');
    Route::post('/delete',  'delete')->name('notice.delete');
});

// For Seller
Route::prefix('seller/notice')->controller(NoticeController::class)->middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/', 'notifindex')->name('notices.notifindex'); // List and show latest notice
    Route::get('/{id}', 'show')->name('notices.show'); // Show a specific notice
    Route::get('/notice/{id}/view-pdf', 'viewPdf')->name('notice.viewPdf'); // View PDF file
});

Route::group(['prefix' => 'admin/setting'], function () {
    Route::get('/general', [SettingController::class, 'general'])->name('admin.setting.general');
    Route::get('/static-content', [SettingController::class, 'staticContent'])->name('admin.setting.static.content');
    Route::get('/legal-content', [SettingController::class, 'legalContent'])->name('admin.setting.legal.content');
    Route::post('/update', [SettingController::class, 'update'])->name('admin.setting.update');
    Route::get('/change-language', [SettingController::class, 'changeLanguage'])->name('admin.setting.change.language');
});

// Seller Routes

Route::prefix('seller/complaint')->controller(SellerComplaintController::class)->middleware(['auth', 'role:seller'])->group(function () {

    Route::get('/', 'index')->name('seller.complain.index');
    Route::get('/list',  'getList')->name('seller.complain.list');
    Route::get('/create',  'create')->name('seller.complain.create');
    Route::post('/store',  'store')->name('seller.complain.store');
    Route::get('/edit',  'edit')->name('seller.complain.edit');
    Route::post('/update',  'update')->name('seller.complain.update');
    Route::post('/delete',  'delete')->name('seller.complain.delete');



    // Route::get('/seller/complaints', 'index')->name('seller.complaints');
    // Route::post('/seller/complaint','store')->name('seller.complaint.store');
    
});

// Admin Routes

Route::prefix('admin/complaint')->controller(AdminComplaintController::class)
->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/',  'index')->name('admin.complain.index');
    Route::post('/',  'store')->name('admin.complain.store');
    Route::get('/list',  'getUsers')->name('admin.complain.list');
    Route::get('/{id}/edit',  'edit')->name('admin.complain.edit');
    Route::delete('/{id}',  'destroy')->name('admin.complain.destroy');
    Route::get('/complaint/details', 'getComplaintDetails')->name('complaint.details');
    Route::post('update-status', 'updateStatus')->name('admin.complaints');
   
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/mail', [AdminMailController::class, 'showMailForm'])->name('admin.mail.form');
    Route::post('/admin/mail/send', [AdminMailController::class, 'sendMail'])->name('admin.mail.send');
});


// seller payments

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('seller/payments/offline', [PaymentController::class, 'showOfflinePaymentForm'])->name('seller.payments.offline');
    Route::post('seller/payments/submit-offline', [PaymentController::class, 'submitOfflinePayment'])->name('seller.payments.submitOffline');
    Route::get('seller/payments/history', [PaymentController::class, 'showPaymentHistory'])->name('seller.payments.history');
});

// admin payments

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/payments/history', [PaymentController::class, 'adminPaymentHistory'])->name('admin.payments.history');
    Route::get('/admin/payments/edit/{id}', [PaymentController::class, 'editPayment'])->name('admin.payments.edit');
    Route::put('/admin/payments/update/{id}', [PaymentController::class, 'updatePayment'])->name('admin.payments.update');
    Route::delete('/admin/payments/delete/{id}', [PaymentController::class, 'deletePayment'])->name('admin.payments.delete');
});






// Route::get('/edit',  'edit')->name('admin.eventcategory.edit');
// Route::post('/update',  'update')->name('admin.eventcategory.update');
// Route::post('/delete',  'delete')->name('admin.eventcategory.delete');
