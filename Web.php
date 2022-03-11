<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\catagoryController;
use App\Http\Controllers\sitesettingController;


// Backend Route

//Backend Login Route

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login.form');
    Route::post('/login', 'LoginController@login')->name('admin.login');
// echo "ghghghghgh";
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    });
});

//admin book

    Route::resource('admin/book', 'Backend\adminbookcontroller', ['names' => 'adminbook']);
    Route::get('admin/uploadedbook', 'Backend\adminbookcontroller@uploadedBooks')->name('adminUploadedBooks');
    Route::get('admin/updateBookStatus/{id}/{type}', 'Backend\adminbookcontroller@updateBookStatus')->name('updateBookStatus');
    Route::get('admin/addWriter', 'Backend\adminbookcontroller@adminAddWriter')->name('adminAddWriter');
    Route::post('admin/createWriter', 'Backend\adminbookcontroller@createWriter')->name('createWriter');
    Route::get('admin/ViewAudioPage/{id}', 'Backend\adminbookcontroller@ViewAudioPageCont')->name('ViewAudioPage');
    Route::post('admin/updateAudio', 'Backend\adminbookcontroller@updateAudio')->name('updateAudio');
    Route::post('admin/updatedAudio', 'Backend\adminbookcontroller@updatedAudio')->name('updatedAudio');
    Route::get('admin/ViewSingleBook/{id}', 'Backend\adminbookcontroller@ViewSingleBook')->name('ViewSingleBook');
    Route::get('admin/editAudioView/{id}', 'Backend\adminbookcontroller@editAudioView')->name('editAudioView');
    Route::get('admin/deleteBook/{id}', 'Backend\adminbookcontroller@deleteBook')->name('deleteBook');    
    
    //Admin Package
      Route::get('admin/package', 'Backend\adminpackageController@packageupload')->name('adminpackage');
      Route::post('admin/storepackage', 'Backend\adminpackageController@packagestore')->name('adminstorepackage');
      Route::get('admin/viewAllpackage', 'Backend\adminpackageController@uploadedPackages')->name('adminviewAllpackage');
      Route::get('admin/ViewSinglePackage/{id}', 'Backend\adminpackageController@ViewEvryPackage')->name('adminViewSinglePackage');
      Route::get('admin/storepackage/{id}', 'Backend\adminpackageController@packageDelete')->name('adminPackageDelete');
      Route::get('admin/addPackageBook', 'Backend\adminpackageController@PackageBook')->name('adminaddPackageBook');
      Route::post('admin/packbook', 'Backend\adminpackageController@pacBookUpload')->name('adminpackbook');
      
    
//site setting

    //Route::get('admin/sitesetting.index', 'sitesettingController@sitesetting')->name('sitesetting.index');
    // Route::post('admin/sitesettingstore', 'sitesettingController@sitesettingstore')->name('sitesettingstore');
    
//Backend  writer Login Route
//writerbook
    Route::resource('writer/book', 'Backend\writerBookController', ['names' => 'writerbook']);

Route::group(['namespace' => 'Writer', 'prefix' => 'writer'], function () {
     Route::get('/login', 'LoginController@showLoginForm')->name('writer.login.form');
    Route::post('/login', 'LoginController@login')->name('writer.login');
// echo "ghghghghgh";
    Route::middleware(['auth:writers'])->group(function () {
        Route::post('Auth/logout', 'LoginController@logout')->name('Writer.logout');
        Route::get('Auth/dashboard', 'DashboardController@index')->name('Writer.dashboard');
    });
    Route::get('/register', 'RegisterController@showRegForm')->name('writer.register.form');
    Route::resource('writer', 'WriterRegistration', ['names' => 'writer.back.reg']);
    
   //Route::post('/register', 'RegisterController@store')->name('writer.backend.register');
});



// Route::namespace('Writer')->prefix('writer')->group(function () {
    
//     Route::get('/login', '\Auth\LoginController@showLoginForm')->name('writer.login.form');
//     Route::post('/login', '\Auth\LoginController@login')->name('writer.login');
//     Route::middleware(['auth:writers'])->group(function () {
        
//         Route::post('/logout', 'LoginController@logout')->name('writer.logout');
//         Route::get('/dashboard', 'DashboardController@index')->name('writer.dashboard');
        
//     });
    
// });
//writer registration Insert
Route::post('writer_registration_insert', 'Backend\WriterRegistration@store')->name('writer_registration_insert');
Route::post('login.writer.ww', 'Backend\WriterRegistration@writerLogin')->name('login.writer.ww');
Route::get('writer/uploadbook', 'Backend\WriterRegistration@bookUploadBywriter')->name('writerUploadbook');
Route::get('write-profile', 'Backend\WriterRegistration@writeProfile')->name('write.profile');
Route::get('write-profile-edit', 'Backend\WriterRegistration@writeProfileEdit')->name('write.profile.edit');
Route::put('write-profile-update', 'Backend\WriterRegistration@writerProfileUpdate')->name('write.profile.update');
Route::get('wallet', 'Backend\WriterRegistration@writerWallet')->name('wallet');
Route::get('mybook', 'Backend\WriterRegistration@writerbooks')->name('mybook');
Route::get('MainBook', 'Backend\WriterRegistration@WriterBookView')->name('MainBook');
Route::get('mybook/{id}', 'Backend\WriterRegistration@BookDelete')->name('BookDelete');
Route::get('get-sub-catagory/{id}', 'Backend\WriterRegistration@ajaxsubcat')->name('ajaxsubcat');
// Backend Controller Route 

// //writer Wallet
// Route::resource('wallet','Backend\WalletController@index')->name('wallet');

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    //Route::get('/', 'IndexController@index')->name('index');
    
    //Admin Hero

    Route::resource('hero', 'HeroController', ['names' => 'admin.hero']);
    Route::post('hero/inactive', 'HeroController@inactive')->name('admin.hero.inactive');

    //Admin Profile

    Route::get('profile', 'ProfileController@index')->name('admin.profile');
    Route::put('profile-update', 'ProfileController@updateProfile')->name('admin.profile.update');
    Route::get('password', 'ProfileController@Password')->name('admin.password');
    Route::put('password-update', 'ProfileController@updatePassword')->name('admin.update.password');
    
        // category

        Route::resource('category', 'CategoryController', ['names' => 'category']);
        Route::post('category/inactive', 'CategoryController@inactive')->name('category.inactive');
         // SubCategory

    Route::resource('SubCategory', 'SubCategoryController', ['names' => 'SubCategory']);
    Route::post('SubCategory/inactive', 'SubCategoryController@inactive')->name('SubCategory.inactive');

    

    //Publication     
    Route::resource('publication', 'PublicationController', ['names' => 'admin.publication']);
    Route::get('publication/delete/{id}', 'PublicationController@publicationDelete')->name('admin.publicationDelete');
     
     
      //Book uploade     
    Route::resource('book_uploade', 'bookuploadeController', ['names' => 'admin.book_uploade']);
    //Route::get('publication/delete/{id}', 'PublicationController@publicationDelete')->name('admin.publicationDelete');
    Route::get('get-sub-catagory/{id}', 'Backend\WriterRegistration@ajaxsubcat')->name('ajaxsubcat');
  
            
    // Admin General Setting

    Route::get('setting', 'SettingController@index')->name('admin.setting');
    Route::patch('setting-update', 'SettingController@update')->name('admin.setting.update');

    // Admin Appearance Setting

    Route::get('appearance', 'SettingController@appearance')->name('admin.appearance');
    Route::patch('appearance-update', 'SettingController@appearanceUpdate')->name('admin.appearance.update');

    // Admin Mail Setting

    Route::get('mail', 'SettingController@mail')->name('admin.mail');
    Route::patch('mail-update', 'SettingController@mailUpdate')->name('admin.mail.update');
    
    //admin subscriptions
    
   // Route::get('publication/delete/{id}', 'PublicationController@publicationDelete')->name('admin.publicationDelete');
    Route::resource('subscriptions', 'subscriptionscontroller', ['names' => 'adminsubscriptions']);
    Route::post('subscriptions/inactive', 'subscriptionscontroller@inactive')->name('subscriptions.inactive');
    // Route::post('subscriptions/create', 'subscriptionscontroller@create')->name('adminsubscriptionssubscreate');
//site setting
    Route::resource('Sitesetting', 'SitesettingController', ['names' => 'Sitesetting']);
    Route::post('Sitesetting/store', 'SitesettingController@store')->name('subscriptionstore');
//writer approve

    Route::resource('writerapprove', 'WriterapproveController', ['names' => 'admin.writerapprove']);

 //Orders    
    Route::resource('order', 'orderController', ['names' => 'admin.order']);
    
    //Cupon
    Route::resource('cupon', 'CuponController', ['names' => 'admin.cupon']);
   
    
    
});


// Backend Controller writer Route 

// Route::group(['namespace' => 'Backend', 'prefix' => 'writer', 'middleware' => 'auth:writer'], function () {
    
//     //Route::get('/', 'IndexController@index')->name('index');

//     //writer reg
//     Route::resource('hero', 'HeroController', ['names' => 'admin.hero']);
//     Route::post('hero/inactive', 'HeroController@inactive')->name('admin.hero.inactive');

// });



// Frontend Route

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/contact', 'IndexController@contact')->name('contact');
    Route::get('/test', 'IndexController@test')->name('test');
});

//Route::view('/ss', 'backend.property.index')->name('ss');


Auth::routes();

// Socialite routes
Route::group(['as' => 'login.', 'prefix' => 'login', 'namespace' => 'Auth'], function () {
    Route::get('/{provider}', 'LoginController@redirectToProvider')->name('provider');
    Route::get('/{provider}/callback', 'LoginController@handleProviderCallback')->name('callback');
});

Route::get('/home', 'HomeController@index')->name('home');
