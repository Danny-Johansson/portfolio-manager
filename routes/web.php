<?php

use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CertificateIssuerController;
use App\Http\Controllers\DemonstrationController;
use App\Http\Controllers\DemonstrationTypeController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExperienceTypeController;
use App\Http\Controllers\JobsearchController;
use App\Http\Controllers\JobsearchStatusController;
use App\Http\Controllers\JobsearchTypeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LanguageLevelController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillLevelController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TagCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Login Related
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

// Pages
Route::get('/', [PageController::class, 'root'])->name('root');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/resume', [PageController::class, 'resume'])->name('resume');

// Projects
Route::middleware(['auth'])->group(function () {
    Route::get('/projects/deleted', [ProjectController::class,'deleted'])->name('projects.deleted');
    Route::get('/projects/{project}/restore', [ProjectController::class,'restore'])->name('projects.restore');
    Route::delete('/projects/{project}/forceDelete', [ProjectController::class,'destroy_force'])->name('projects.forceDelete');
});
Route::resource('projects', ProjectController::class);

// Demonstrations
Route::middleware(['auth'])->group(function () {
    Route::get('/demonstrations/deleted', [DemonstrationController::class,'deleted'])->name('demonstrations.deleted');
    Route::get('/demonstrations/{demonstration}/restore', [DemonstrationController::class,'restore'])->name('demonstrations.restore');
    Route::delete('/demonstrations/{demonstration}/forceDelete', [DemonstrationController::class,'destroy_force'])->name('demonstrations.forceDelete');
});
Route::get('/demonstrations/{demonstration}/demo', [DemonstrationController::class, 'demo'])->name('demo');
Route::resource('demonstrations', DemonstrationController::class);

// Job Searches
Route::middleware(['auth'])->group(function () {
    Route::get('/jobsearches/deleted', [JobsearchController::class,'deleted'])->name('jobsearches.deleted');
    Route::get('/jobsearches/{jobsearch}/restore', [JobsearchController::class,'restore'])->name('jobsearches.restore');
    Route::delete('/jobsearches/{jobsearch}/forceDelete', [JobsearchController::class,'destroy_force'])->name('jobsearches.forceDelete');
});
Route::resource('jobsearches', JobsearchController::class);

/*
 * Administration
 */
Route::middleware(['auth'])->group(function () {
    // Pages
    Route::get('/home', [PageController::class, 'home'])->name('home');

    /*
     * System Related
     */

    // Users
    Route::get('/users/deleted', [UserController::class,'deleted'])->name('users.deleted');
    Route::get('/users/{user}/restore', [UserController::class,'restore'])->name('users.restore');
    Route::delete('/users/{user}/forceDelete', [UserController::class,'destroy_force'])->name('users.forceDelete');
    Route::resource('users',UserController::class);

    // Roles
    Route::get('/roles/deleted', [RoleController::class,'deleted'])->name('roles.deleted');
    Route::get('/roles/{role}/restore', [RoleController::class,'restore'])->name('roles.restore');
    Route::delete('/roles/{role}/forceDelete', [RoleController::class,'destroy_force'])->name('roles.forceDelete');
    Route::resource('roles', RoleController::class);

    /*
     * Portfolio Related
     */

    // Demonstration Types
    Route::get('/demonstrationTypes/deleted', [DemonstrationTypeController::class,'deleted'])->name('demonstrationTypes.deleted');
    Route::get('/demonstrationTypes/{projectFeature}/restore', [DemonstrationTypeController::class,'restore'])->name('demonstrationTypes.restore');
    Route::delete('/demonstrationTypes/{projectFeature}/forceDelete', [DemonstrationTypeController::class,'destroy_force'])->name('demonstrationTypes.forceDelete');
    Route::resource('demonstrationTypes', DemonstrationTypeController::class);

    // Tag Categories
    Route::get('/tagCategories/deleted', [TagCategoryController::class,'deleted'])->name('tagCategories.deleted');
    Route::get('/tagCategories/{tagCategory}/restore', [TagCategoryController::class,'restore'])->name('tagCategories.restore');
    Route::delete('/tagCategories/{tagCategory}/forceDelete', [TagCategoryController::class,'destroy_force'])->name('tagCategories.forceDelete');
    Route::resource('tagCategories',TagCategoryController::class);

    // Tags
    Route::get('/tags/deleted', [TagController::class,'deleted'])->name('tags.deleted');
    Route::get('/tags/{tag}/restore', [TagController::class,'restore'])->name('tags.restore');
    Route::delete('/tags/{tag}/forceDelete', [TagController::class,'destroy_force'])->name('tags.forceDelete');
    Route::resource('tags',TagController::class);

    /*
     * Resume Related
     */

    // Owner
    Route::get('/owner/image', [OwnerController::class,'image_form'])->name('owner.image.form');
    Route::put('/owner/image', [OwnerController::class,'image_submit'])->name('owner.image.submit');
    Route::resource('owner',OwnerController::class)->only(['index','edit','update']);

    // Language Levels
    Route::get('/languageLevels/deleted', [LanguageLevelController::class,'deleted'])->name('languageLevels.deleted');
    Route::get('/languageLevels/{languageLevel}/restore', [LanguageLevelController::class,'restore'])->name('languageLevels.restore');
    Route::delete('/languageLevels/{languageLevel}/forceDelete', [LanguageLevelController::class,'destroy_force'])->name('languageLevels.forceDelete');
    Route::resource('languageLevels', LanguageLevelController::class);

    // Languages
    Route::get('/languages/deleted', [LanguageController::class,'deleted'])->name('languages.deleted');
    Route::get('/languages/{language}/restore', [LanguageController::class,'restore'])->name('languages.restore');
    Route::delete('/languages/{language}/forceDelete', [LanguageController::class,'destroy_force'])->name('languages.forceDelete');
    Route::resource('languages', LanguageController::class);

    // Skill Levels
    Route::get('/skillLevels/deleted', [SkillLevelController::class,'deleted'])->name('skillLevels.deleted');
    Route::get('/skillLevels/{skillLevel}/restore', [SkillLevelController::class,'restore'])->name('skillLevels.restore');
    Route::delete('/skillLevels/{skillLevel}/forceDelete', [SkillLevelController::class,'destroy_force'])->name('skillLevels.forceDelete');
    Route::resource('skillLevels', SkillLevelController::class);

    // Skills
    Route::get('/skills/deleted', [SkillController::class,'deleted'])->name('skills.deleted');
    Route::get('/skills/{skill}/restore', [SkillController::class,'restore'])->name('skills.restore');
    Route::delete('/skills/{skill}/forceDelete', [SkillController::class,'destroy_force'])->name('skills.forceDelete');
    Route::resource('skills', SkillController::class);

    // Experience Types
    Route::get('/experienceTypes/deleted', [ExperienceTypeController::class,'deleted'])->name('experienceTypes.deleted');
    Route::get('/experienceTypes/{experienceType}/restore', [ExperienceTypeController::class,'restore'])->name('experienceTypes.restore');
    Route::delete('/experienceTypes/{experienceType}/forceDelete', [ExperienceTypeController::class,'destroy_force'])->name('experienceTypes.forceDelete');
    Route::resource('experienceTypes', ExperienceTypeController::class);

    // Experiences
    Route::get('/experiences/deleted', [ExperienceController::class,'deleted'])->name('experiences.deleted');
    Route::get('/experiences/{experience}/restore', [ExperienceController::class,'restore'])->name('experiences.restore');
    Route::delete('/experiences/{experience}/forceDelete', [ExperienceController::class,'destroy_force'])->name('experiences.forceDelete');
    Route::resource('experiences', ExperienceController::class);

    // Socials
    Route::get('/socials/deleted', [SocialController::class,'deleted'])->name('socials.deleted');
    Route::get('/socials/{social}/restore', [SocialController::class,'restore'])->name('socials.restore');
    Route::delete('/socials/{social}/forceDelete', [SocialController::class,'destroy_force'])->name('socials.forceDelete');
    Route::get('/socials/{social}/logo', [SocialController::class,'logo_form'])->name('socials.logo.form');
    Route::put('/socials/{social}/logo', [SocialController::class,'logo_submit'])->name('socials.logo.submit');
    Route::resource('socials', SocialController::class);

    // Certificate Issuers
    Route::get('/certificateIssuers/deleted', [CertificateIssuerController::class,'deleted'])->name('certificateIssuers.deleted');
    Route::get('/certificateIssuers/{experienceType}/restore', [CertificateIssuerController::class,'restore'])->name('certificateIssuers.restore');
    Route::delete('/certificateIssuers/{experienceType}/forceDelete', [CertificateIssuerController::class,'destroy_force'])->name('certificateIssuers.forceDelete');
    Route::resource('certificateIssuers', CertificateIssuerController::class);

    // Certificates
    Route::get('/certificates/deleted', [CertificateController::class,'deleted'])->name('certificates.deleted');
    Route::get('/certificates/{certificate}/restore', [CertificateController::class,'restore'])->name('certificates.restore');
    Route::delete('/certificates/{certificate}/forceDelete', [CertificateController::class,'destroy_force'])->name('certificates.forceDelete');
    Route::get('/certificates/{certificate}/file', [CertificateController::class,'file_form'])->name('certificates.file.form');
    Route::put('/certificates/{certificate}/file', [CertificateController::class,'file_submit'])->name('certificates.file.submit');
    Route::resource('certificates', CertificateController::class);

    /*
     * Job Search Related
     */

    // Job Searches Status
    Route::get('/jobsearchStatuses/deleted', [JobsearchStatusController::class,'deleted'])->name('jobsearchStatuses.deleted');
    Route::get('/jobsearchStatuses/{jobsearchStatus}/restore', [JobsearchStatusController::class,'restore'])->name('jobsearchStatuses.restore');
    Route::delete('/jobsearchStatuses/{jobsearchStatus}/forceDelete', [JobsearchStatusController::class,'destroy_force'])->name('jobsearchStatuses.forceDelete');
    Route::resource('jobsearchStatuses', JobsearchStatusController::class);

    // Job Searches Type
    Route::get('/jobsearchTypes/deleted', [JobsearchTypeController::class,'deleted'])->name('jobsearchTypes.deleted');
    Route::get('/jobsearchTypes/{jobsearchType}/restore', [JobsearchTypeController::class,'restore'])->name('jobsearchTypes.restore');
    Route::delete('/jobsearchTypes/{jobsearchType}/forceDelete', [JobsearchTypeController::class,'destroy_force'])->name('jobsearchTypes.forceDelete');
    Route::resource('jobsearchTypes', JobsearchTypeController::class);

});

// Artisan Related
Route::get('/Artisan/cache', [ArtisanController::class, 'cacheAll'])->name('artisan.cache.all');
Route::get('/Artisan/cache/route', [ArtisanController::class, 'cacheRoute'])->name('artisan.cache.route');
Route::get('/Artisan/cache/config', [ArtisanController::class, 'cacheConfig'])->name('artisan.cache.config');
Route::get('/Artisan/cache/view', [ArtisanController::class, 'cacheView'])->name('artisan.cache.view');
Route::get('/Artisan/clear', [ArtisanController::class, 'clearAll'])->name('artisan.clear.all');
Route::get('/Artisan/clear/route', [ArtisanController::class, 'clearRoute'])->name('artisan.clear.route');
Route::get('/Artisan/clear/config', [ArtisanController::class, 'clearConfig'])->name('artisan.clear.config');
Route::get('/Artisan/clear/view', [ArtisanController::class, 'clearView'])->name('artisan.clear.view');
