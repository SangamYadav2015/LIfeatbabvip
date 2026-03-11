<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\Applicant\ApplicantAuthController;




Route::get('/test', function () {
    return response()->json(['message' => 'CORS working!']);
});

Route::middleware('api.token')->group(function () {
    Route::prefix('site')->group(function () {
        // for dynamic csrf//
        Route::get('/csrf-token', function (Request $request) {
            Session::regenerateToken(); // Force new CSRF token
            return response()->json(['csrf_token' => csrf_token()]);
        });
        // for dynamic csrf//

        Route::get('/headmenu', [SiteController::class, 'headMenu'])->name('site.headMenu');
        Route::get('/footermenu', [SiteController::class, 'footerMenu'])->name('site.footerMenu');
        Route::get('/sitesetting', [SiteController::class, 'siteSetting'])->name('site.siteSetting');
        Route::get('/pagedata/{slug}', [SiteController::class, 'pageData'])->name('site.pageData');
        Route::get('/ishomepage', [SiteController::class, 'isHomePage'])->name('site.isHomePage');
        Route::post('/savemaintinanceenquiry', [SiteController::class, 'saveMaintinanceEnquiry'])->name('saveMaintinanceEnquiry');
        Route::get('/latestthreeblogs', [SiteController::class, 'latestThreeBlogs'])->name('site.latestThreeBlogs');
        Route::get('/blogspaginate', [SiteController::class, 'blogsPaginate'])->name('site.blogsPaginate');
        Route::get('/blogdetails/{slug}', [SiteController::class, 'blogDetails'])->name('site.blogDetails');
        Route::get('/latestteam', [SiteController::class, 'latestTeam'])->name('site.latestTeam');
        Route::get('/allteammember', [SiteController::class, 'allTeamMember'])->name('site.allTeamMember');
        Route::get('/helpdata', [SiteController::class, 'helpData'])->name('site.helpData');
        Route::get('/helpdetails/{slug}', [SiteController::class, 'helpDetails'])->name('site.helpDetails');
        Route::get('/privacystyle2', [SiteController::class, 'privacyStyle2'])->name('site.privacyStyle2');
        Route::get('/latestsixjobs', [SiteController::class, 'latestSixJobs'])->name('site.latestSixJobs');
        Route::get('/jobdetail/{slug}', [SiteController::class, 'jobDetail'])->name('site.jobDetail');
        Route::get('/alldepartment', [SiteController::class, 'allDepartment'])->name('site.allDepartment');
        Route::get('/alljobs', [SiteController::class, 'allJobs'])->name('site.allJobs');
        Route::get('/alllocationsdata', [SiteController::class, 'allLocationsData'])->name('site.allLocationsData');


    });
});

Route::prefix('applicant')->group(function () {
    
    // Login
    Route::post('/login', [ApplicantAuthController::class, 'login'])->name('applicant.api.login');

    // Logout
    Route::post('/logout', [ApplicantAuthController::class, 'logout'])->name('applicant.api.logout');

    // Optional: Registration form placeholder for frontend clients
    Route::get('/register-form', [ApplicantAuthController::class, 'showRegistrationForm'])->name('applicant.api.registerForm');
    
    Route::get('/login-form', [ApplicantAuthController::class, 'showLoginForm'])->name('applicant.api.loginForm');

    Route::post('/register', [ApplicantAuthController::class, 'register'])->name('api.applicant.register');
    Route::post('/verify', [ApplicantAuthController::class, 'verify'])->name('api.applicant.verify');
    Route::post('/accept-terms', [ApplicantAuthController::class, 'acceptTerms'])->name('api.applicant.accept-terms');
    Route::get('/forgot-password-form', [ApplicantAuthController::class, 'showForgotPasswordForm'])->name('api.applicant.forgot-password-form');
    Route::get('/verify-link', [ApplicantAuthController::class, 'verify'])->name('api.applicant.verify-link');


    // Future endpoints (optional)
    // Route::post('/register', [ApplicantAuthController::class, 'register'])->name('applicant.api.register');
    // Route::post('/change-password', [ApplicantAuthController::class, 'changePassword'])->name('applicant.api.changePassword');
    Route::get('/applicant/dashboard', [ApplicantAuthController::class, 'dashboard']);
   Route::get('/two-step-verification', [ApplicantAuthController::class, 'verifyTwoStepApplicantApi'])->name('api.applicant.two-step');



});
Route::middleware('auth.applicant.api')->prefix('applicant')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ApplicantAuthController::class, 'dashboard'])->name('api.applicant.dashboard');

    // Change password
    Route::get('/change-password-form', [ApplicantAuthController::class, 'showChangePasswordFormApi'])->name('api.applicant.change-password-form');
    Route::post('/update-password', [ApplicantAuthController::class, 'updatePasswordApi'])->name('api.applicant.update-password');

    // 2FA
    Route::post('/verify-2fa', [ApplicantAuthController::class, 'verifyLoginTwoStepApplicantApi'])->name('api.applicant.verify-2fa');
    Route::get('/two-step-verification', [ApplicantAuthController::class, 'verifyTwoStepApplicantApi'])->name('api.applicant.two-step');

    // Profile & Info

   

    // Email verification
    Route::post('/verify/email', [ApplicantAuthController::class, 'verifyEmail'])->name('applicant.verify.email');
    
 
        
        Route::get('/profile', [ApplicantAuthController::class, 'showProfile'])->name('applicant.api.profileapi');
        
Route::get('/editprofileapi', [ApplicantAuthController::class, 'editProfileApi']);
Route::get('/{id}/verification-data', [ApplicantAuthController::class, 'getVerificationData']);

Route::post('/update-step', [ApplicantAuthController::class, 'updateProfileApi'])->name('applicant.api.profileupdate');

  Route::post('/upodateprofile-image', [ApplicantAuthController::class, 'profileImage'])
        ->name('applicant.profileImage');

    // Fetch profile image (if only retrieving without upload)
    Route::get('/profile-image', [ApplicantAuthController::class, 'profileImage'])
        ->name('applicant.getProfileImage');
        Route::post('/profile-imageupdate', [ApplicantAuthController::class, 'profileImageupdate'])
        ->name('applicant.profile.image');

});





Route::prefix('site')->group(function () {
Route::post('/savecontactenquiry', [SiteController::class, 'saveContactEnquiry'])->name('saveContactEnquiry');
Route::post('/savenewsletterapi', [SiteController::class, 'saveNewsletterAPI'])->name('saveNewsletterAPI');
Route::get('/portfoliodetail/{portSlug}', [SiteController::class, 'portfolioDetails'])->name('site.portfolioDetails');
Route::get('/checkloginapplicant', [SiteController::class, 'checkLoginApplicant'])->name('site.checkLoginApplicant');

});
// for post API//
