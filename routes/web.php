<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AutoLogoutMiddleware;
use App\Http\Middleware\TwoFactorAuthMiddleware;
use App\Http\Controllers\Admin\TermsAndConditionsController;
use App\Http\Middleware\ApplicantMiddleware;
use App\Http\Middleware\TwoFactorAuthApplicantMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SectionStyleController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\ContactEnqueryController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriber;
use App\Http\Controllers\Admin\LoginAttemptController;
use App\Http\Controllers\Admin\MaintinanceEnqueryController;
use App\Http\Controllers\Admin\TwoStepAuthController;
use App\Http\Controllers\Applicant\TwoStepAuthController as ApplicantTwoStepAuthController;
use App\Http\Controllers\Admin\HelpCategoryController;
use App\Http\Controllers\Admin\HelpFaqController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\CustomResetPasswordController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Applicant\ApplicantAuthController;
use App\Http\Controllers\ApplicantDetailsController;
use App\Http\Controllers\Admin\PrivacyPolicyCategoryController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Applicant\FaqFrontendController;


// Route::get('/', function () {
//     return view('welcome');
// });

// route for forgot passsword//
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [CustomResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [CustomResetPasswordController::class, 'reset'])
->name('password.update');

// route for forgot passsword//

// route for applicant forgot passsword//

Route::get('applicant/password/reset', [ForgotPasswordController::class, 'showLinkRequestFormApplicant'])->name('applicant.password.request');
Route::post('applicant/password/email', [ForgotPasswordController::class, 'sendResetLinkEmailApplicant'])->name('applicant.password.email');
Route::get('applicant/password/reset/{token}', [CustomResetPasswordController::class, 'showResetFormApplicant'])->name('applicant.password.reset');
Route::post('applicant/password/reset', [CustomResetPasswordController::class, 'applicantreset'])
->name('applicant.password.update');
// route for applicant forgot passsword//

//for Admin //

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/adminLogin', [AdminController::class, 'login'])->name('admin.checkLogin');
    Route::get('/admin-login-verify', [AdminController::class, 'verifytwostep'])->name('admin.verifytwostep');
    Route::post('/veryfylogintwostep', [AdminController::class, 'veryfyLoginTwostep'])->name('admin.veryfyLoginTwostep');
    // route for admin login and check login//

});

Route::delete('/admin/contact-enquery/{id}', [ContactEnqueryController::class, 'destroy'])->name('admin.contact-enquery.destroy');
Route::get('get/applicants', [AdminController::class, 'getapplicantaccount'])->name('admin.getapplicant');
Route::delete('/admin/applicant/{id}', [AdminController::class, 'destroy'])->name('admin.applicant.destroy');
Route::prefix('admin')->middleware([AdminMiddleware::class, TwoFactorAuthMiddleware::class, AutoLogoutMiddleware::class ])->group(function () {
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/applicant/update-status', [AdminController::class, 'updateApplicantStatus'])->name('admin.updateApplicantStatus');

// Add admin routes here//

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/sectionlist', [SectionController::class, 'index'])->name('admin.sectionList');
Route::post('/sectionstatusupdate', [SectionController::class, 'UpdateSectionStatus'])->name('admin.updateSectionStatus');

// Section Styles form//

Route::get('/sectionstylelist', [SectionStyleController::class, 'index'])->name('admin.sectionstyleList');
Route::get('/addsectionstyle', [SectionStyleController::class, 'addSectionStyle'])->name('admin.addSectionStyle');
Route::post('/section-style/check-name', [SectionStyleController::class, 'checkNameExistence'])->name('admin.checkSectionStyleName');
Route::post('/storeSectionStyle', [SectionStyleController::class, 'storeSectionStyle'])->name('admin.storeSectionStyleName');
Route::get('/editSectionStyle/{num}', [SectionStyleController::class, 'editSectionStyle'])->name('admin.editSectionStyleName');
Route::post('/updateSectionStyle/{num}', [SectionStyleController::class, 'updateSectionStyle'])->name('admin.updateSectionStyleName');
Route::delete('/deleteSectionStyle/{num}', [SectionStyleController::class, 'deleteSectionStyle'])->name('admin.deleteSectionStyle');
Route::post('/sectionstylestatusupdate', [SectionStyleController::class, 'UpdateSectionStyleStatus'])->name('admin.updateSectionStyleStatus');

// Section Styles form End//

// menu start //

Route::get('/menulist', [MenuController::class, 'index'])->name('admin.menuList');
Route::get('/addmenu', [MenuController::class, 'addMenu'])->name('admin.addMenu');
Route::post('/menu/check-name', [MenuController::class, 'menuNameExistance'])->name('admin.menuNameExistance');
Route::get('/menuChildSortNumber', [MenuController::class, 'childMenuSortNumber'])->name('admin.menuChildSortNumber');
Route::get('/editmenu/{num}', [MenuController::class, 'editMenu'])->name('admin.editMenu');
Route::post('/updatemenu/{num}', [MenuController::class, 'updataMenu'])->name('admin.updataMenu');
Route::delete('/deletemenu/{num}', [MenuController::class, 'deleteMenu'])->name('admin.deleteMenu');
Route::get('/menuSorting', [MenuController::class, 'menuSorting'])->name('admin.menuSorting');
Route::post('/updateSortMenu', [MenuController::class, 'updateSortMenu'])->name('admin.updateSortMenu');

// menu end //

// pages start//

Route::get('/pagelist', [PageController::class, 'index'])->name('admin.pageList');
Route::get('/addpage', [PageController::class, 'addPage'])->name('admin.addPage');
Route::post('/checkpagemenu', [PageController::class, 'checkPageMenu'])->name('admin.checkPageMenu');
Route::post('/storepage', [PageController::class, 'storePage'])->name('admin.storePage');
Route::post('/pagechangestatus', [PageController::class, 'pageChangeStatus'])->name('admin.pageChangeStatus');
Route::get('/editpage/{num}', [PageController::class, 'editPage'])->name('admin.editPage');
Route::post('/updatepage/{num}', [PageController::class, 'updatePage'])->name('admin.updatePage');
Route::delete('/deletepage/{num}', [PageController::class, 'deletePage'])->name('admin.deletePage');

// pages//

// pages Section//

Route::get('/pagesectionlist/{num}', [PageSectionController::class, 'index'])->name('admin.PageSectionList');
Route::get('/addpagesection/{num}', [PageSectionController::class, 'addPageSection'])->name('admin.addPageSection');
Route::post('/dynamicsectionStyle', [PageSectionController::class, 'dynamicSectionStyle'])->name('admin.dynamicSectionStyle');
Route::post('/seciondynamicform', [PageSectionController::class, 'secionDynamicForm'])->name('admin.secionDynamicForm');
Route::post('/styleimagepreview', [PageSectionController::class, 'styleImagePreview'])->name('admin.styleImagePreview');
Route::post('/pagesectionstore/{id?}', [PageSectionController::class, 'pageSectionStore'])->name('admin.pageSectionStore');
Route::post('/pagesectionchangestatus', [PageSectionController::class, 'pageSectionChangeStatus'])->name('admin.pageSectionChangeStatus');
Route::post('/savepagesectionsorting', [PageSectionController::class, 'savePageSectionSorting'])->name('admin.savePageSectionSorting');
Route::get('/editpagesection/{num}', [PageSectionController::class, 'editPageSection'])->name('admin.editPageSection');
Route::delete('/deletepagesection/{num}/{id}', [PageSectionController::class, 'deletePageSection'])->name('admin.deletePageSection');

// pages Section//

// Setting//

Route::get('/site-setting', [SettingsController::class, 'siteSetting'])->name('admin.siteSetting');
Route::post('/savesitesetting', [SettingsController::class, 'saveSiteSetting'])->name('admin.saveSiteSetting');
Route::get('/footer-setting', [SettingsController::class, 'footerSetting'])->name('admin.footerSetting');
Route::post('/savefootersetting', [SettingsController::class, 'saveFooterSetting'])->name('admin.saveFooterSetting');
Route::get('/third-party-setting', [SettingsController::class, 'thirdPartySetting'])->name('admin.thirdPartySetting');
Route::post('/savesetting', [SettingsController::class, 'saveSetting'])->name('admin.saveSetting');

// Setting//

// Blog Category//

Route::get('/blogcatrgorylist', [BlogCategoryController::class, 'index'])->name('admin.blogCatrgoryList');
Route::get('/blogcatrgoryadd', [BlogCategoryController::class, 'add'])->name('admin.addBlogCategory');
Route::post('/checknewscategory', [BlogCategoryController::class, 'checknewsCategory'])->name('admin.checknewsCategory');
Route::post('/blogcatrgorystore/{id?}', [BlogCategoryController::class, 'blogCatrgoryStore'])->name('admin.blogCatrgoryStore');
Route::post('/updateblogcategorystatus', [BlogCategoryController::class, 'updateBlogCategoryStatus'])->name('admin.updateBlogCategoryStatus');
Route::get('/editblogcategory/{num}', [BlogCategoryController::class, 'editBlogCategory'])->name('admin.editBlogCategory');
Route::post('/updateblogcategory/{num}', [BlogCategoryController::class, 'updateBlogCategory'])->name('admin.updateBlogCategory');
Route::delete('/deleteblogcategory/{num}', [BlogCategoryController::class, 'deleteBlogCategory'])->name('admin.deleteBlogCategory');

// Blog Category//

// Blogs//

Route::get('/bloglist', [BlogController::class, 'index'])->name('admin.blogList');
Route::get('/blogadd', [BlogController::class, 'add'])->name('admin.blogAdd');
Route::post('/blogstore/{id?}', [BlogController::class, 'blogStore'])->name('admin.blogStore');
Route::post('/updateblogstatus', [BlogController::class, 'updateBlogStatus'])->name('admin.updateBlogStatus');
Route::get('/editblog/{num}', [BlogController::class, 'editBlog'])->name('admin.editBlog');
Route::post('/updateblog/{num}', [BlogController::class, 'updateBlog'])->name('admin.updateBlog');
Route::delete('/deleteblog/{num}', [BlogController::class, 'deleteBlog'])->name('admin.deleteBlog');
Route::post('/updateblogstatus', [BlogController::class, 'updateBlogStatus'])->name('admin.updateBlogStatus');
Route::get('/blogsetting', [BlogController::class, 'blogSetting'])->name('admin.blogSetting');
Route::post('/saveblogsetting', [BlogController::class, 'saveBlogSetting'])->name('admin.saveBlogSetting');

// Blogs//

// Team//

Route::get('/teamlist', [TeamController::class, 'index'])->name('admin.teamList');
Route::get('/addteam', [TeamController::class, 'addTeam'])->name('admin.addTeam');
Route::post('/storeteam', [TeamController::class, 'storeTeam'])->name('admin.storeTeam');
Route::get('/editteam/{num}', [TeamController::class, 'editTeam'])->name('admin.editTeam');
Route::post('/updateteam/{num}', [TeamController::class, 'updateTeam'])->name('admin.updateTeam');
Route::delete('/deleteteam/{num}', [TeamController::class, 'deleteTeam'])->name('admin.deleteTeam');

// Team//

// Logs //

Route::get('/logslist', [LogsController::class, 'index'])->name('admin.logsList');
Route::get('/viewlogs/{num}', [LogsController::class, 'viewLogs'])->name('admin.viewlogs');
Route::post('/updatelogstatus', [LogsController::class, 'updateLogStatus'])->name('admin.updateLogStatus');

// Logs//

// User Role//

Route::get('/rolelist', [UserRoleController::class, 'index'])->name('admin.roleList');
Route::get('/addrole', [UserRoleController::class, 'addRole'])->name('admin.addRole');
Route::post('/rolestore', [UserRoleController::class, 'roleStore'])->name('admin.roleStore');
Route::post('/checkrole', [UserRoleController::class, 'checkRole'])->name('admin.checkRole');
Route::get('/editrole/{num}', [UserRoleController::class, 'editRole'])->name('admin.editRole');
Route::post('/updaterole/{num}', [UserRoleController::class, 'updateRole'])->name('admin.updateRole');
Route::delete('/deleterole/{num}', [UserRoleController::class, 'deleteRole'])->name('admin.deleteRole');

// User Role//

// User //

Route::get('/userlist', [UserController::class, 'index'])->name('admin.userList');
Route::get('/adduser', [UserController::class, 'addUser'])->name('admin.addUser');
Route::post('/userstore', [UserController::class, 'userStore'])->name('admin.userStore');
Route::post('/checkemail', [UserController::class, 'checkEmail'])->name('admin.checkEmail');
Route::get('/edituser/{num}', [UserController::class, 'editUser'])->name('admin.editUser');
Route::post('/updateuser/{num}', [UserController::class, 'updateUser'])->name('admin.updateUser');
Route::delete('/deleteuser/{num}', [UserController::class, 'deleteUser'])->name('admin.deleteUser');
Route::post('/userchangestatus', [UserController::class, 'userChangeStatus'])->name('admin.userChangeStatus');
Route::post('/getdynamicrole', [UserController::class, 'getDynamicRole'])->name('admin.getDynamicRole');
Route::get('/userprofile', [UserController::class, 'userProfile'])->name('admin.userProfile');
Route::post('/updateprofile/{num}', [UserController::class, 'updateProfile'])->name('admin.updateProfile');
Route::get('/changepassword', [UserController::class, 'changePassword'])->name('admin.changePassword');
Route::post('/checkcurrentpassword', [UserController::class, 'checkCurrentPassword'])->name('admin.checkCurrentPassword');
Route::post('/updatepassword', [UserController::class, 'updatePassword'])->name('admin.updatePassword');

// User //

// Show form for adding a new department

Route::get('/departments/add', [DepartmentController::class, 'AddDepartment'])->name('admin.departments.add');
Route::post('admin/check-department-name', [DepartmentController::class, 'checkDepartmentName'])->name('admin.checkDepartmentName');

// Store a new department

Route::post('/departments/store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/departmentlist', [DepartmentController::class, 'index'])->name('admin.departmentList');
Route::get('/editdepartment/{num}', [DepartmentController::class, 'editDepartment'])->name('admin.editDepartment');
Route::post('/updatedepartment/{num}', [DepartmentController::class, 'updateDepartment'])->name('admin.updateDepartment');

// Department //

// Enquery //

Route::get('/enquerylist', [ContactEnqueryController::class, 'index'])->name('admin.enqueryList');
Route::get('/enquerylistexport', [ContactEnqueryController::class, 'enqueryListExport'])->name('admin.enqueryListExport');
Route::get('/subscriberlist', [AdminSubscriber::class, 'index'])->name('admin.subscriberList');
Route::patch('/admin/subscribers/{id}/toggle-status', [SubscriberController::class, 'toggleStatus'])->name('admin.subscriber.toggleStatus');

// Enquery //

// LoginAttemptController //

Route::get('/invalidloginattempt', [LoginAttemptController::class, 'index'])->name('admin.invalidLoginAttempt');

// LoginAttemptController //

// Maintinance Enquery //

Route::get('/maintinanceenquerylist', [MaintinanceEnqueryController::class, 'index'])->name('admin.maintinanceEnqueryList');
Route::get('/maintinanceenqueryexport', [MaintinanceEnqueryController::class, 'maintinanceEnqueryExport'])->name('admin.maintinanceEnqueryExport');

// Maintinance Enquery //

// For Admin Google Authenticator

Route::get('/2fa/enable', [TwoStepAuthController::class, 'enable2FA'])->name('admin.enable2fa');
Route::post('/2fa/verify', [TwoStepAuthController::class, 'verify2FA'])->name('admin.verify2fa');
Route::post('/2fa/disable', [TwoStepAuthController::class, 'disable2FA'])->name('admin.disable2fa');

// Help Category//

Route::get('/helpcategory', [HelpCategoryController::class, 'index'])->name('admin.helpCategory');
Route::get('/helpcategoryadd', [HelpCategoryController::class, 'add'])->name('admin.addHelpCategory');
Route::post('/checkhelpcategory', [HelpCategoryController::class, 'checkHelpCategory'])->name('admin.checkHelpCategory');
Route::post('/helpcatrgorystore', [HelpCategoryController::class, 'helpCatrgoryStore'])->name('admin.helpCatrgoryStore');
Route::post('/updatehelpcategorystatus', [HelpCategoryController::class, 'updateHelpCategoryStatus'])->name('admin.updateHelpCategoryStatus');
Route::get('/edithelpcategory/{num}', [HelpCategoryController::class, 'editHelpCategory'])->name('admin.editHelpCategory');
Route::post('/updatehelpcategory/{num}', [HelpCategoryController::class, 'updateHelpCategory'])->name('admin.updateHelpCategory');
Route::delete('/deletehelpcategory/{num}', [HelpCategoryController::class, 'deleteHelpCategory'])->name('admin.deleteHelpCategory');

// Help Category//

//Company Controller //

Route::get('/admin/Companylist', [CompanyController::class, 'AllCompany'])->name('admin.companylist');
Route::get('/Company', [CompanyController::class, 'AddCompany'])->name('admin.addcompany');
Route::get('/editcompany/{num}', [CompanyController::class, 'EditCompany'])->name('admin.editcompany');
Route::delete('/deletecompany/{num}', [CompanyController::class, 'DeleteCompany'])->name('admin.deletecompany');
Route::post('/updatecompany/{num}', [CompanyController::class, 'UpdateCompany'])->name('admin.updatecompany');
Route::post('/storecompany', [CompanyController::class, 'StoreCompany'])->name('admin.companystore');

//company Controller//

//PostJOB Controller//

Route::get('/admin/joblist', [JobController::class, 'AllJob'])->name('admin.joblist');
Route::get('/admin/addjob', [JobController::class, 'AddJob'])->name('admin.addjob');
Route::get('/editjob/{num}', [JobController::class, 'EditJob'])->name('admin.editjob');
Route::delete('/deletejob/{num}', [JobController::class, 'DeleteJob'])->name('admin.deletejob');
Route::post('/updatejob/{num}', [JobController::class, 'UpdateJob'])->name('admin.updatejob');
Route::post('/storejob', [JobController::class, 'StoreJob'])->name('admin.jobstore');
Route::post('/admin/updatejobstatus', [JobController::class, 'UpdateJobStatus'])->name('admin.updatejobstatus');
Route::get('jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/post-jobs/import', [JobController::class, 'imports'])->name('post-jobs.import');
Route::get('/admin/addsetting', [JobController::class, 'createSetting'])->name('admin.addsetting');
Route::post('/career-setting/store', [JobController::class, 'storeCareerSetting'])->name('admin.carrerstore');
Route::get('/all/carrersetting', [JobController::class, 'AllCareerSetting'])->name('admin.carrerlist');
Route::delete('/career-settings/{id}', [JobController::class, 'deleteCareerSetting'])->name('career.settings.delete');
Route::get('/admin/career-settings/{id}/edit', [JobController::class, 'editCareerSetting'])
    ->name('admin.careerSettings.edit');
Route::post('/admin/career-settings/{id}', [JobController::class, 'updateCareerSetting'])
    ->name('admin.careerSettings.update');

//postjob controller//

//apply job//

Route::get('locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('locations/create', [LocationController::class, 'create'])->name('locations.create');
Route::post('locations/store', [LocationController::class, 'store'])->name('locations.store');
Route::get('locations/{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');
Route::put('locations/{id}', [LocationController::class, 'update'])->name('locations.update');
Route::delete('locations/{id}', [LocationController::class, 'destroy'])->name('locations.destroy');

// Update Status Route (AJAX)

Route::post('locations/status', [LocationController::class, 'updateStatus'])->name('locations.updateStatus');

// Help Faq//

Route::get('/helpfaqlist', [HelpFaqController::class, 'index'])->name('admin.helpFaqList');
Route::get('/helpfaqadd', [HelpFaqController::class, 'add'])->name('admin.helpFaqAdd');
Route::post('/helpfaqstore', [HelpFaqController::class, 'helpFaqStore'])->name('admin.helpFaqStore');
Route::post('/updatehelpfaqstatus', [HelpFaqController::class, 'updateHelpFaqstatus'])->name('admin.updateHelpFaqstatus');
Route::get('/editfaqhelp/{num}', [HelpFaqController::class, 'editFaqHelp'])->name('admin.editFaqHelp');
Route::post('/updatefaqhelplog/{num}', [HelpFaqController::class, 'updateFaqHelplog'])->name('admin.updateFaqHelplog');
Route::delete('/deletefaqhelp/{num}', [HelpFaqController::class, 'deleteFaqHelp'])->name('admin.deleteFaqHelp');

// Help Faq//

// Privacy Policy Category//

Route::get('/privacypolicycategory', [PrivacyPolicyCategoryController::class, 'index'])->name('admin.privacyPolicyCategory');
Route::get('/privacypolicycategoryadd', [PrivacyPolicyCategoryController::class, 'add'])->name('admin.privacyPolicyCategoryAdd');
Route::post('/checkprivacypolicycategory', [PrivacyPolicyCategoryController::class, 'checkPrivacyPolicyCategory'])->name('admin.checkPrivacyPolicyCategory');
Route::post('/privacypolicycatrgorystore', [PrivacyPolicyCategoryController::class, 'privacyPolicyCatrgoryStore'])->name('admin.privacyPolicyCatrgoryStore');
Route::post('/updateprivacypolicycategorystatus', [PrivacyPolicyCategoryController::class, 'updatePrivacyPolicyCategoryStatus'])->name('admin.updatePrivacyPolicyCategoryStatus');
Route::get('/editprivacypolicycategory/{num}', [PrivacyPolicyCategoryController::class, 'editPrivacyPolicyCategory'])->name('admin.editPrivacyPolicyCategory');
Route::post('/updateprivacypolicycategory/{num}', [PrivacyPolicyCategoryController::class, 'updatePrivacyPolicyCategory'])->name('admin.updatePrivacyPolicyCategory');
Route::delete('/deleteprivacypolicycategory/{num}', [PrivacyPolicyCategoryController::class, 'deletePrivacyPolicyCategory'])->name('admin.deletePrivacyPolicyCategory');

// Privacy Policy Category//

// Privacy Policy //

Route::get('/privacypolicylist', [PrivacyPolicyController::class, 'index'])->name('admin.privacyPolicyList');
Route::get('/privacypolicyadd', [PrivacyPolicyController::class, 'add'])->name('admin.privacyPolicyAdd');
Route::post('/privacypolicystore', [PrivacyPolicyController::class, 'privacyPolicyStore'])->name('admin.privacyPolicyStore');
Route::post('/updateprivacypolicystatus', [PrivacyPolicyController::class, 'updatePrivacyPolicyStatus'])->name('admin.updatePrivacyPolicyStatus');
Route::get('/editprivacypolicy/{num}', [PrivacyPolicyController::class, 'editPrivacyPolicy'])->name('admin.editPrivacyPolicy');
Route::post('/updateprivacypolicylog/{num}', [PrivacyPolicyController::class, 'updatePrivacyPolicyLog'])->name('admin.updatePrivacyPolicyLog');
Route::delete('/deleteprivacypolicy{num}', [PrivacyPolicyController::class, 'deletePrivacyPolicy'])->name('admin.deletePrivacyPolicy');

// Privacy Policy //

// Faq //

Route::get('/faq', [FaqController::class, 'index'])->name('admin.faq.index');
Route::get('/faqadd', [FaqController::class, 'add'])->name('admin.FaqAdd');
Route::post('/faq/store', [FaqController::class, 'store'])->name('admin.faq.store');
Route::post('/updatefaqstatus', [FaqController::class, 'updateFaqStatus'])->name('admin.updateFaqStatus');
Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('admin.faq.edit');
Route::post('/faq/update/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
Route::delete('/faq/delete/{id}', [FaqController::class, 'deleteFaq'])->name('admin.faq.delete');

});

//for Admin//

// for site frontend//

// Route::get('/', [SiteController::class, 'home'])->name('home');

// Route::get('{slug}', [SiteController::class, 'show'])->name('pages.show');

// Route::get('blog/{slug}', [SiteController::class, 'blogDetails'])->name('pages.blogDetails');

// Route::get('site/contactus', [ContactUsController::class, 'index'])->name('contactme');

// Route::post('/saveContact', [ContactUsController::class, 'saveContact'])->name('saveContact');

// Route::post('/saveMaintinanceenquery', [MaintinanceEnqueryController::class, 'saveMaintinanceEnquery'])->name('saveMaintinanceEnquery');

// Route::post('/savenewsletter', [SubscriberController::class, 'saveNewsletter'])->name('saveNewsletter');

// // Route::get('help/{slug}', [SiteController::class, 'helpDetails'])->name('site.helpDetails');

// Route::get('help/search/helpautocomplete', [SiteController::class, 'helpAutoComplete'])->name('site.helpAutoComplete');

// Route::get('jobs/{slug}', [SiteController::class, 'jobDetails'])->name('jobs.details');

// Route::get('/find/jobs', [SiteController::class, 'seeAllJobsWithFilter'])->name('see.alljobs');

// Route::get('/filter/jobs', [SiteController::class, 'filter'])->name('jobs.filter');

// Route::get('wishlist', [SiteController::class, 'viewWishlist'])->name('wishlist.view');

// Route::post('wishlist/add/{job}', [SiteController::class, 'addToWishlist'])->name('wishlist.add');

// Route::delete('wishlist/remove/{job}', [SiteController::class, 'removeFromWishlist'])->name('wishlist.remove');


// Terms and condition  Routes


// Terms and Conditions

Route::prefix('admin')->group(function () {
  Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'index'])->name('admin.terms.index');
  Route::get('/terms-and-conditions/create', [TermsAndConditionsController::class, 'create'])->name('admin.terms.create');
  Route::post('/terms-and-conditions', [TermsAndConditionsController::class, 'store'])->name('admin.terms.store');
  Route::get('/terms-and-conditions/edit/{id}', [TermsAndConditionsController::class, 'edit'])->name('admin.terms.edit');
  Route::post('/terms-and-conditions/update/{id}', [TermsAndConditionsController::class, 'update'])->name('admin.terms.update');
  Route::delete('/terms-and-conditions/delete/{id}', [TermsAndConditionsController::class, 'delete'])
  ->name('admin.terms.delete');});
  Route::get('/notification/{id}', [AdminController::class, 'show'])->name('notification.show');
  Route::get('joining-letter/{notificationId}', [AdminController::class, 'downloadJoiningLetter'])->name('joining.letter');
  Route::post('/offer/accept/{id}', [AdminController::class, 'acceptOffer'])->name('offer.accept');

// Update password

// Secured Routes (requires authentication)


Route::prefix('applicant')->group(function () {

    Route::get('/applicant-login-verify', [ApplicantAuthController::class, 'verifytwostepapplicant'])->name('applicant.verifytwostepapplicant');
    Route::post('/veryfylogintwostep', [ApplicantAuthController::class, 'veryfyLoginTwostepApplicant'])->name('applicant.veryfyLoginTwostepApplicant');
    });
    Route::prefix('applicant')->group(function () {
    Route::get('/2fa/enable', [ApplicantTwoStepAuthController::class, 'enable2FA'])->name('applicant.enable2fa');
    Route::post('/2fa/verify', [ApplicantTwoStepAuthController::class, 'verify2FA'])->name('applicant.verify2fa');
    Route::post('/2fa/disable', [ApplicantTwoStepAuthController::class, 'disable2FA'])->name('applicant.disable2fa');
    Route::get('/login', [ApplicantAuthController::class, 'showLoginForm'])->name('applicant.login');
    Route::get('/profile/{applicantId}', [ApplicantAuthController::class, 'showProfile'])->name('applicant.profile');
    Route::post('/work-experience/store', [ApplicantAuthController::class, 'storeWorkExperience'])->name('applicant.storeWorkExperience');
    Route::put('/profile/{applicantId}/update-image', [ApplicantAuthController::class, 'updateProfileImage'])->name('update.profile.image');
    Route::post('/login', [ApplicantAuthController::class, 'login']);
    Route::get('/register', [ApplicantAuthController::class, 'showRegistrationForm'])->name('applicant.register');
    Route::post('/register', [ApplicantAuthController::class, 'register']);
    Route::get('/verify', [ApplicantAuthController::class, 'verify'])
    ->name('applicant.verify-link')
    ->middleware('signed');
    Route::post('/logout', [ApplicantAuthController::class, 'logout'])->name('applicant.logout');
    Route::get('/applicant/accept-terms', [ApplicantAuthController::class, 'showAcceptTerms'])->name('applicant.acceptTerms');
    Route::post('/applicant/accept-terms', [ApplicantAuthController::class, 'acceptTerms'])->name('applicant.acceptTerms.post');

    // Apply the ApplicantMiddleware for protected routes
    
    Route::middleware([ApplicantMiddleware::class,TwoFactorAuthApplicantMiddleware::class])->group(function () {
        Route::get('/dashboard', [ApplicantAuthController::class, 'dashboard'])->name('applicant.dashboard');
    });

});

// Applicant authentication routes

Route::middleware([ApplicantMiddleware::class])->group(function () {
  Route::get('job/job-application-store', [JobApplicationController::class, 'apply'])
      ->name('job.application.store');

});

// Route to show the verification form

Route::post('applicant/verification/store', [ApplicantAuthController::class, 'storeVerificationData'])->name('verification.store');
Route::get('/verification/{jobId}/{applicantId}/{step}', [ApplicantAuthController::class, 'showVerificationForm'])
    ->name('verification.form');

// Edit the profile (to show the form)


// Update the profile (to save changes)
Route::put('/applicant/{applicantId}/profile', [ApplicantAuthController::class, 'updateProfile'])->name('applicant.updateProfile');
Route::get('/applicant/{applicantId}/job/{jobId}/status', [AdminController::class, 'showJobApplicationStatus'])->name('applicant.jobApplicationStatus');
Route::get('/admin/applicants', [AdminController::class, 'showAllVerifiedApplicants'])->name('applicants');
Route::get('/admin/applicant/{id}', [AdminController::class, 'showApplicant'])->name('applicant.show');
Route::get('/interview-schedule/{applicant_id}', [AdminController::class, 'showAvailabilityForm'])->name('interview.schedule.form');
Route::post('/interview-schedule/store/{applicant_id}', [AdminController::class, 'storeAvailability'])->name('interview.store.availability');
Route::get('/admin/availabilities', [AdminController::class, 'listAllAvailability'])->name('admin.availabilities');
Route::get('/applicant/forgot-password', [ApplicantAuthController::class, 'showForgotPasswordForm'])
    ->name('applicant.forgot.password');

// Show change password form
Route::get('/applicant/change-password', [ApplicantAuthController::class, 'showChangePasswordForm'])->name('applicant.change-password');

// Handle password update
Route::post('/applicant/change-password', [ApplicantAuthController::class, 'updatePassword'])->name('applicant.update-password');
Route::post('/admin/applicant/update-status', [AdminController::class, 'updateStatusAjax'])
    ->name('admin.applicant.updateStatus'); // ✅ This is your actual route name
Route::middleware(['auth:applicant'])->prefix('applicant')->group(function () {
});
// Route for completion

Route::get('/{applicantId}/profile/edit', [ApplicantAuthController::class, 'editProfile'])->name('applicant.editProfile');
Route::post('applicant/update/personal/{id}', [ApplicantAuthController::class, 'updatePersonalInfo'])->name('applicant.personal.update');
Route::post('applicant/update/education/{id}', [ApplicantAuthController::class, 'updateEducationInfo'])->name('applicant.education.update');
Route::post('applicant/update/work/{id}', [ApplicantAuthController::class, 'updateWorkInfo'])->name('applicant.work.update');
Route::post('applicant/update/documents/{id}', [ApplicantAuthController::class, 'updateDocuments'])->name('applicant.documents.update');
Route::post('/applicant/faq/{id}', [ApplicantAuthController::class, 'updateFaqAnswers'])->name('applicant.faq.update');

// Route group for Terms and Conditions


// Route for React frontend do not delete it//

Route::get('/{any}', function () {

    $path = public_path('react/index.html');



    if (File::exists($path)) {

        return Response::file($path);

    }



    abort(404);

})->where('any', '.*');

// route for React frontend do not delete it//

