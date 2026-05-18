<?php

use App\Http\Controllers\Panel\CourseSectionController;
use App\Http\Controllers\Panel\CourseLessonController;
use App\Http\Controllers\Panel\CvcPageContentController;
use App\Http\Controllers\Panel\CvcSectionContentController;
use App\Http\Controllers\Panel\ChangePasswordController;
use App\Http\Controllers\Panel\CareerApplicationController;
use App\Http\Controllers\Panel\CheckoutController;
use App\Http\Controllers\Panel\ContactMessageController;
use App\Http\Controllers\Panel\ContentController;
use App\Http\Controllers\Panel\CourseController;
use App\Http\Controllers\Panel\EmploeeController;
use App\Http\Controllers\Panel\FilemanagerController;
use App\Http\Controllers\Panel\IndexController as PanelIndexController;
use App\Http\Controllers\Panel\MenupanelController;
use App\Http\Controllers\Panel\MenusiteController;
use App\Http\Controllers\Panel\OfferController;
use App\Http\Controllers\Panel\PaneluserController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\ProductController as PanelProductController;
use App\Http\Controllers\Panel\ProfileController as PanelProfileController;
use App\Http\Controllers\Panel\ReportController;
use App\Http\Controllers\Panel\RequestuserController;
use App\Http\Controllers\Panel\RoleuserController;
use App\Http\Controllers\Panel\SiteuserController;
use App\Http\Controllers\Panel\SubmenupanelController;
use App\Http\Controllers\Panel\SubmenusiteController;
use App\Http\Controllers\Site\CvcController;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

//Route::namespace('App\Http\Controllers\Site')->group(function () {
//
//    $sitemenus  = Menu::select('slug', 'class', 'submenu')->whereType('site')->whereStatus(4)->get();
//    $submenus   = Submenu::select('id', 'slug', 'class')->whereType('site')->whereStatus(4)->get();
//
//    foreach ($sitemenus as $menu) {
//        if ($menu->submenu == 0) {
//            Route::get($menu->slug, 'IndexController@' . $menu->class)->name($menu->slug);
//        } else {
//            foreach ($submenus as $submenu) {
//                if ($submenu->menu_id == $menu->id) {
//                    Route::get($menu->slug . '/' . $submenu->slug, 'IndexController@' . $submenu->class);
//                }
//            }
//        }
//    }
//
//    ///Route::get('/'                    , 'IndexController@index')->name('/');
//
//});
//
//
//Route::get('اخبار'.'/'.'{slug}'              , [App\Http\Controllers\Site\IndexController::class, 'singleakhbar']);
//Route::get('نمونه-قراردادها'.'/'.'{slug}'    , [App\Http\Controllers\Site\IndexController::class, 'singlecontract']);
//Route::get('تیم-ما'.'/'.'رزومه'.'/'.'{slug}' , [App\Http\Controllers\Site\IndexController::class, 'emploeeresume']);
//Route::get('محتوای-آموزشی'.'/'.'{slug}'      , [App\Http\Controllers\Site\IndexController::class, 'singlepost']);
//Route::get('/reload-captcha'                 , [App\Http\Controllers\Site\IndexController::class, 'reloadCaptcha']);
//Route::get('دپارتمان-اموزش-و-پژوهش/دوره-های-آموزشی'.'/'.'{slug}'   , [App\Http\Controllers\Site\IndexController::class, 'singleworkshop']);
//
//
//Route::middleware('admin')->namespace('App\Http\Controllers\Panel')->group(function () {
//    Route::get('panel/'                    , 'IndexController@index')->name('dashboard');
//    Route::get('panel/dashboard'           , 'IndexController@index')->name('dashboard');
//    Route::resource('panel/menupanel'    , 'MenupanelController');
//    Route::resource('panel/submenupanel' , 'SubmenupanelController');
//    Route::resource('panel/paneluser'    , 'PaneluserController');
//    Route::resource('panel/roleuser'     , 'RoleuserController');
//    Route::resource('panel/filemanager'  , 'FilemanagerController');
//    Route::resource('panel/offer'        , 'OfferController');
//    Route::resource('panel/requestuser'  , 'RequestuserController');
//    Route::resource('panel/content'      , 'ContentController');
//    Route::resource('panel/product'      , 'ProductController');
//    Route::resource('panel/siteuser'     , 'SiteuserController');
//    Route::resource('panel/wallet'       , 'WalletController');
//    Route::resource('panel/invoice'      , 'InvoiceController');
//    Route::resource('panel/menusite'     , 'MenusiteController');
//    Route::resource('panel/submenusite'  , 'SubmenusiteController');
//    Route::resource('panel/transaction'  , 'TransactionController');
//    Route::resource('panel/content'      , 'ContentController');
//    Route::resource('panel/emploee'      , 'EmploeeController');
//    Route::resource('panel/report'      , 'ReportController');
//    Route::resource('panel/checkout'      , 'CheckoutController');
//
//    Route::get('payment.callback'   , 'WalletController@callbackpay')           ->name('payment.callback');
//    Route::post('discountcheck'     , 'ProfileController@discountcheck')        ->name('discountcheck');
//    Route::get('payment-success'    , 'ProfileController@pay')                  ->name('payment-success');
//    Route::get('payment-failed'     , 'ProfileController@pay')                  ->name('payment-failed');
//    Route::post('setinvoice'        , 'InvoiceController@setinvoice')           ->name('setinvoice');
//    Route::post('payment'           , 'WalletController@payment')               ->name('payment');
//    Route::delete('invoicedestroy'  , 'InvoiceController@invoicedestroy')       ->name('invoicedestroy');
//
//    Route::resource('panel/course', 'CourseController');
//    Route::resource('panel/course-section', CourseSectionController::class)->except(['create','show']);
//    Route::resource('panel/course-lesson', CourseLessonController::class)->except(['create','show']);
//
//
//
//
//
////    Route::resource('panel/leveluser'    , 'LeveluserController');
//
//    Route::get('panel/profile'            , 'ProfileController@index')->name('profile');
//    Route::get('panel/userdata'           , 'ProfileController@userdata')->name('userdata');
//    Route::post('panel/getsubmenu'        , 'IndexController@getsubmenu')->name('getsubmenu');
//
//    Route::get('panel/changepassword'      , 'ChangePasswordController@index')->name('password.change.form');
//    Route::post('panel/changepassword'     , 'ChangePasswordController@change')->name('password.change.submit');
//
//    Route::post('panel/filestatus'         , 'FilemanagerController@filestatus')->name('filestatus');
//    Route::post('panel/store'              , 'FilemanagerController@store')     ->name('storemedia');
//    Route::get('panel/selectfile'          , 'FilemanagerController@selectfile')->name('selectfile');
//    Route::delete('panel/deletefile'       , 'FilemanagerController@deletefile')->name('deletefile');
//
//});
//
Auth::routes();

Route::post('panel/fullregister', [App\Http\Controllers\Auth\FullRegisterController::class, 'register'])->name('fullregister');
Route::patch('panel/fullregister/{id}', [App\Http\Controllers\Auth\FullRegisterController::class, 'update'])->name('fullregister.update');
Route::get('logout', [App\Http\Controllers\Auth\FullRegisterController::class, 'logout'])->name('logout');
Route::post('logout', [App\Http\Controllers\Auth\FullRegisterController::class, 'logout']);
Route::get('login/{provider}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('redirectToProvider');
Route::get('login/{provider}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('handleProviderCallback');
Route::get('otplogin', [App\Http\Controllers\Auth\LoginController::class, 'otplogin'])->name('otplogin');
Route::post('gettoken', [App\Http\Controllers\Auth\LoginController::class, 'gettoken'])->name('gettoken');
Route::get('sendtoken', [App\Http\Controllers\Auth\LoginController::class, 'sendtoken'])->name('sendtoken');
Route::post('checktoken', [App\Http\Controllers\Auth\LoginController::class, 'checktoken'])->name('checktoken');

Route::prefix('panel')->middleware('admin')->group(function () {
    Route::get('/', [PanelIndexController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [PanelIndexController::class, 'index']);

    Route::resource('menupanel', MenupanelController::class);
    Route::resource('submenupanel', SubmenupanelController::class);
    Route::resource('paneluser', PaneluserController::class);
    Route::resource('roleuser', RoleuserController::class);
    Route::resource('filemanager', FilemanagerController::class);
    Route::resource('offer', OfferController::class);
    Route::resource('requestuser', RequestuserController::class);
    Route::resource('content', ContentController::class);
    Route::resource('post', PostController::class)->except(['create', 'show']);
    Route::resource('product', PanelProductController::class);
    Route::resource('siteuser', SiteuserController::class);
    Route::resource('menusite', MenusiteController::class);
    Route::resource('submenusite', SubmenusiteController::class);
    Route::resource('emploee', EmploeeController::class);
    Route::resource('report', ReportController::class);
    Route::resource('checkout', CheckoutController::class);
    Route::resource('course', CourseController::class);
    Route::resource('contact-message', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::resource('career-application', CareerApplicationController::class)->only(['index', 'show', 'destroy']);
    Route::get('cvc-content/domains', [CvcSectionContentController::class, 'domains'])->name('panel.cvc-content.domains');
    Route::get('cvc-content/faq', [CvcSectionContentController::class, 'faq'])->name('panel.cvc-content.faq');
    Route::get('cvc-content/investment', [CvcSectionContentController::class, 'investment'])->name('panel.cvc-content.investment');
    Route::get('cvc-content/investment-process', [CvcSectionContentController::class, 'investmentProcess'])->name('panel.cvc-content.investment-process');
    Route::get('cvc-page-content/home', [CvcPageContentController::class, 'home'])->name('panel.cvc-page-content.home');
    Route::get('cvc-page-content/home3', [CvcPageContentController::class, 'home3'])->name('panel.cvc-page-content.home3');
    Route::get('cvc-page-content/about', [CvcPageContentController::class, 'about'])->name('panel.cvc-page-content.about');
    Route::get('cvc-page-content/contact', [CvcPageContentController::class, 'contact'])->name('panel.cvc-page-content.contact');
    Route::get('cvc-page-content/career', [CvcPageContentController::class, 'career'])->name('panel.cvc-page-content.career');
    Route::put('cvc-page-content/{pageKey}', [CvcPageContentController::class, 'update'])->name('panel.cvc-page-content.update');
    Route::post('cvc-content/{sectionKey}', [CvcSectionContentController::class, 'store'])->name('panel.cvc-content.store');
    Route::put('cvc-content/{sectionKey}', [CvcSectionContentController::class, 'update'])->name('panel.cvc-content.update');
    Route::patch('contact-message/{contact_message}/status', [ContactMessageController::class, 'updateStatus'])->name('contact-message.status');
    Route::patch('career-application/{career_application}/status', [CareerApplicationController::class, 'updateStatus'])->name('career-application.status');
    Route::get('career-application/{career_application}/resume', [CareerApplicationController::class, 'downloadResume'])->name('career-application.resume');
    Route::get('career-application/{career_application}/documents', [CareerApplicationController::class, 'downloadDocuments'])->name('career-application.documents');
    Route::resource('course-section', CourseSectionController::class)->except(['create', 'show']);
    Route::resource('course-lesson', CourseLessonController::class)->except(['create', 'show']);

    Route::get('profile', [PanelProfileController::class, 'index'])->name('profile');
    Route::get('userdata', [PanelProfileController::class, 'userdata'])->name('userdata');
    Route::post('getsubmenu', [PanelIndexController::class, 'getsubmenu'])->name('getsubmenu');

    Route::get('changepassword', [ChangePasswordController::class, 'index'])->name('password.change.form');
    Route::post('changepassword', [ChangePasswordController::class, 'change'])->name('password.change.submit');

    Route::post('filestatus', [FilemanagerController::class, 'filestatus'])->name('filestatus');
    Route::post('store', [FilemanagerController::class, 'store'])->name('storemedia');
    Route::get('selectfile', [FilemanagerController::class, 'selectfile'])->name('selectfile');
    Route::delete('deletefile', [FilemanagerController::class, 'deletefile'])->name('deletefile');
});

Route::post('discountcheck', [PanelProfileController::class, 'discountcheck'])->name('discountcheck');

Route::get('/storage/{path}', function (string $path) {
    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*');

Route::name('cvc.')->group(function () {
    Route::get('/', [CvcController::class, 'home'])->name('home');
    Route::get('/home3', [CvcController::class, 'home3'])->name('home3');
    Route::get('/about', [CvcController::class, 'about'])->name('about');
    Route::get('/contact', [CvcController::class, 'contact'])->name('contact');
    Route::post('/contact', [CvcController::class, 'contactSubmit'])->name('contact.submit');
    Route::get('/faq', [CvcController::class, 'faq'])->name('faq');
    Route::get('/investment', [CvcController::class, 'investment'])->name('investment');
    Route::get('/investment-process', [CvcController::class, 'investmentProcess'])->name('investment-process');
    Route::get('/news', [CvcController::class, 'news'])->name('news');
    Route::get('/news/{slug}', [CvcController::class, 'singleNews'])->name('single-news');
    Route::get('/single-news', [CvcController::class, 'legacySingleNews'])->name('single-news-legacy');
    Route::get('/portfolio', [CvcController::class, 'portfolio'])->name('portfolio');
    Route::get('/team', [CvcController::class, 'team'])->name('team');
    Route::get('/team/{slug}', [CvcController::class, 'teamMember'])->name('team-member');
    Route::get('/team-member', [CvcController::class, 'legacyTeamMember'])->name('team-member-legacy');
    Route::get('/career', [CvcController::class, 'career'])->name('career');
    Route::post('/career/apply', [CvcController::class, 'applyCareer'])->name('career.apply');
    Route::get('/domains', [CvcController::class, 'domains'])->name('domains');
});

Route::get('/toggle-theme', function () {
    $theme = session('theme') === 'theme-default-dark' ? 'theme-default' : 'theme-default-dark';
    session(['theme' => $theme]);
    return back();
})->name('toggle-theme');
