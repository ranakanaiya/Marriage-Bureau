<?php

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

Route::get('/', 'Customer\LandingPageController@index')->name('home');
Route::post('/', 'Customer\LandingPageController@customerRegister');
Route::post('/login','Customer\LandingPageController@login')->name('login');

Route::get('admin/login','Admin\UserController@login')->name('admin.login');
Route::post('admin/login','Admin\UserController@loginAttempt')->name('admin.login');

Route::get('/forgot-password','Customer\LandingPageController@forgotpassword')->name('forgot-password');
Route::post('/forgot-password','Customer\LandingPageController@forgotpasswordPost')->name('forgot-password.post');
Route::get('/password-reset/{token}','Customer\LandingPageController@passwordReset')->name('password.reset');
Route::post('/password-reset','Customer\LandingPageController@passwordResetPost')->name('password.reset.post');

Route::get('/landing-aboutus','Customer\LandingPageController@aboutus')->name('landing.aboutus');
Route::get('/landing-contactus','Customer\ContactUsController@contactUsLanding')->name('landing.contactus');
Route::post('/landing-contactus','Customer\ContactUsController@contactUsLandingPost')->name('landing.contactus');

Route::view('/landing-terms-and-conditions','customer.landing-termsandconditions')->name('landing.termsandconditions');
Route::view('/landing-privacy-policy','customer.landing-privacypolicy')->name('landing.privacypolicy');
Route::view('/landing-refund-policy','customer.landing-refundpolicy')->name('landing.refundpolicy');


Route::get('/admin/clear-cache',function(){
    $exitCode = Artisan::call('cache:clear');
    dd($exitCode);
});

Route::group([
    'middleware' => ['auth'],
    'namespace' => 'Customer',
], function () {
    Route::view('/terms-and-conditions','customer.termsandconditions')->name('termsandconditions');
    Route::view('/privacy-policy','customer.privacypolicy')->name('privacypolicy');
    Route::view('/refund-policy','customer.refundpolicy')->name('refundpolicy');

    Route::get('/aboutus','DashboardController@aboutus')->name('aboutus');
    Route::get('/contactus','ContactUsController@contactUs')->name('contactus');
    Route::post('/contactus','ContactUsController@contactUsPost')->name('contactus');

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::post('/dashboard/personal_detail','DashboardController@storePersonalDetail')->name('dashboard.personal_detail');
    Route::post('/dashboard/education_detail','DashboardController@storeEducationDetail')->name('dashboard.education_detail');
    Route::post('/dashboard/family_detail','DashboardController@storeFamilyDetail')->name('dashboard.family_detail');
    Route::post('/dashboard/horoscope_detail','DashboardController@storeHoroscopeDetail')->name('dashboard.horoscope_detail');
    Route::post('/dashboard/profile_picture','DashboardController@storeProfilePicture')->name('dashboard.profile_picture');
    Route::post('/dashboard/login','DashboardController@updateLoginDetail')->name('dashboard.login');

    Route::post('/dashboard/preferences/store','DashboardController@storePreferences')->name('dashboard.preferences.store');
    Route::get('/dashboard/preferences/clear','DashboardController@clearPreferences')->name('dashboard.preferences.clear');

    Route::post('/customer/request/store/{user}','UserRequestController@store')->name('customer.request.store');
    Route::post('/customer/request/{user_request}/accept/{user}','UserRequestController@accept')->name('customer.request.accept');
    Route::post('/customer/request/image/store/{user}','UserRequestController@storeImageRequest')->name('customers.request.image.store');

    Route::get('/customer/{customer}/details','CustomerController@details')->name('customer.details');

    Route::get('/userrequests/index','UserRequestController@index')->name('userrequests.index');

    Route::post('/user/{customer}/block','CustomerController@block')->name('user.block');
    Route::get('/users/blocked','CustomerController@getBlocked')->name('users.blocked');
    Route::post('/user/{customer}/unblock','CustomerController@unBlock')->name('user.unblock');

    /***************************** Subscription Module *********************************************************************************/
    /*** Select plan for payment ***/
    Route::get('/subscription/plans','SubscriptionController@plans')->name('subscription.plans');
    Route::post('/subscription/plans','SubscriptionController@planSubmit')->name('subscription.plans.submit');
    /*** Select plan for payment ***/

    /*** Razorpay ***/
    Route::post('subscription/plans/razorpay/postback','SubscriptionController@razorPostBack')->name('subscription.plans.razorpay.postback');
    /*** Razorpay ***/

    /*** Stripe ***/
    Route::get('/subscription/plans/stripe','SubscriptionController@payByStripe')->name('subscription.plans.stripe');
    Route::get('/subscription/plans/stripe/success','SubscriptionController@stripeSuccess')->name('subscription.plans.stripe.success');
    Route::get('/subscription/plans/stripe/fail','SubscriptionController@stripeFail')->name('subscription.plans.stripe.fail');
    /*** Stripe ***/
    /***************************** Subscription Module *********************************************************************************/

    // Route::post('/subscription/payment','SubscriptionController@payment')->name('subscription.payment');
    // Route::get('/subscription/payment/success','SubscriptionController@paymentSuccess')->name('subscription.payment.success');
    // Route::get('/subscription/payment/fail','SubscriptionController@paymentFail')->name('subscription.payment.fail');

    Route::get('/matchcalculator','MatchCalculatorController@index')->name('matchcalculator');
    Route::post('/matchcalculator/post','MatchCalculatorController@post')->name('matchcalculator.post');

    Route::get('/profile','DashboardController@profile')->name('profile');
    Route::get('/logout','LandingPageController@logout')->name('logout');
});

/***************************** Subscription Module *********************************************************************************/
/*** PayU ***/
Route::post('/subscription/plans/payu/success','Customer\SubscriptionController@payuSuccess')->name('subscription.plans.payu.success');
Route::post('/subscription/plans/payu/fail','Customer\SubscriptionController@payuFail')->name('subscription.plans.payu.fail');
/*** PayU ***/
/***************************** Subscription Module *********************************************************************************/

Route::get('/admin/get/states/{country}/{flg?}','Admin\UtilityController@getStates')->name('admin.get.states');
Route::get('/admin/get/cities/{state}/{flg?}','Admin\UtilityController@getCities')->name('admin.get.cities');

Route::group([
    'middleware'=>['auth','AdminCheck'],
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'as'=>'admin.'
], function () {

    Route::get('logout','UserController@logout')->name('logout');
    Route::get('dashboard','UserController@dashboard')->name('dashboard');

    Route::post('customers/image/update/{customer}','CustomerController@updateImage')->name('customers.image.update');

    Route::get('customers/archived','CustomerController@getArchivedCustomers')->name('customers.archived');

    Route::get('customers/{customer}/details','CustomerController@details')->name('customers.details');

    Route::post('customers/{customer}/block','CustomerController@blockOrUnBlock')->name('customers.block');

    Route::post('customers/{customer}/subscribe','CustomerController@subscribe')->name('customers.subscribe');

    Route::post('customers/{customer}/archive','CustomerController@archive')->name('customers.archive');

    Route::post('customers/{customer}/archive/recover','CustomerController@archivedRecover')->name('customers.archive.recover');

    Route::get('customers/archive/recover/all','CustomerController@archivedRecoverAll')->name('customers.archive.recover.all');

    Route::get('userrequest','UserRequestController@index')->name('userrequest.index');
    Route::get('contactus','ContactUsController@index')->name('contactus.index');

    // Route::get('terms','WebUtilityController@terms')->name('terms');
    // Route::post('terms','WebUtilityController@termsPost')->name('terms');

    // Route::get('privacy-policy','WebUtilityController@privacy')->name('privacy');
    // Route::post('privacy-policy','WebUtilityController@privacyPost')->name('privacy');

    Route::resources([
        'customers'=>'CustomerController',
    ], [
        'except'=>['show'],
    ]);

});
