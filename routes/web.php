<?php


use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Project\Planning\CriteriaController;
use App\Http\Controllers\Project\Planning\DatabaseController;
use App\Http\Controllers\Project\Planning\Overall\DateController;
use App\Http\Controllers\Project\Planning\Overall\DomainController;
use App\Http\Controllers\Project\Planning\Overall\KeywordController;
use App\Http\Controllers\Project\Planning\Overall\LanguageController;
use App\Http\Controllers\Project\Planning\Overall\OverallController;
use App\Http\Controllers\Project\Planning\Overall\StudyTypeController;
use App\Http\Controllers\Project\Planning\ResearchQuestionsController;
use App\Http\Controllers\Project\Planning\SearchStrategyController;
use App\Http\Controllers\Project\Planning\DataExtraction\OptionController;
use App\Http\Controllers\Project\Planning\DataExtraction\QuestionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Project\ReportingController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\SearchProjectController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(Localization::class)->get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Pages controllers

// Auth Controllers

Route::get('/localization/{locale}', LocalizationController::class)->name('localization');

// about and help routes
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/help', [HelpController::class, 'index'])->name('help');
// end of about and help routes
Route::get('/search-project', [SearchProjectController::class, 'searchByTitleOrCreated'])->name('search-project');

// Projects Routes
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index')->middleware('auth');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create')->middleware('auth');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit')->middleware('auth');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy')->middleware('auth');
Route::get('/projects/{id}/add-member', [ProjectController::class, 'add_member'])->name('projects.add');
Route::put('/projects/{id}/add-member', [ProjectController::class, 'add_member_project'])->name('projects.add_member');
Route::delete('/projects/{idProject}/add-member/{idMember}', [ProjectController::class, 'destroy_member'])->name('projects.destroy_member');
Route::put('/projects/{idProject}/members/{idMember}/update-level', [ProjectController::class, 'update_member_level'])->name('projects.update_member_level');
// End of the Projects Routes

// Project Routes
Route::prefix('/project/{projectId}')->group(function () {
    // Planning Routes
    Route::prefix('/planning')->group(function () {
        // Overall Route
        Route::get('/', [OverallController::class, 'index'])
            ->name('project.planning.index')
            ->middleware('auth');

        // Domain Routes
        Route::resource('/domains', DomainController::class)
            ->only(['store', 'update', 'destroy'])
            ->names([
                'store' => 'project.planning.domains.store',
                'update' => 'project.planning.domains.update',
                'destroy' => 'project.planning.domains.destroy',
            ]);

        // Language Routes
        Route::resource('/languages', LanguageController::class)
            ->only(['store', 'destroy'])
            ->names([
                'store' => 'project.planning.languages.store',
                'destroy' => 'project.planning.languages.destroy',
            ]);

        // Study Type Routes
        Route::resource('/study-types', StudyTypeController::class)
            ->only(['store', 'destroy'])
            ->names([
                'store' => 'project.planning.studyTypes.store',
                'destroy' => 'project.planning.studyTypes.destroy',
            ]);

        // Keyword Routes
        Route::resource('/keywords', KeywordController::class)
            ->only(['store', 'update', 'destroy'])
            ->names([
                'store' => 'project.planning.keywords.store',
                'update' => 'project.planning.keywords.update',
                'destroy' => 'project.planning.keywords.destroy',
            ]);

        // Date routes
        Route::prefix('/dates')->group(function () {
            Route::post('/add', [DateController::class, 'addDate'])->name('project.planning.dates.add');
        });

        // Database Routes
        Route::resource('/databases', DatabaseController::class)
            ->only(['store'])
            ->names([
                'store' => 'project.planning.databases.store',
            ]);

        // Add a database to the project
        Route::post('/databases/add/', [DatabaseController::class, 'addDatabase'])
            ->name('project.planning.databases.add');

        // Remove a database from the project
        Route::delete('/databases/remove/{database}', [DatabaseController::class, 'removeDatabase'])
            ->name('project.planning.databases.remove');

        // Search Strategy Route
        Route::put('/search-strategy', [SearchStrategyController::class, 'update'])
            ->name('project.planning.search-strategy.update');

        // Research Questions Routes
        Route::resource('/research-questions', ResearchQuestionsController::class)
            ->only(['store', 'update', 'destroy'])
            ->names([
                'store' => 'project.planning.research-questions.store',
                'update' => 'project.planning.research-questions.update',
                'destroy' => 'project.planning.research-questions.destroy',
            ]);

        // Criteria Routes
        Route::resource('/criteria', CriteriaController::class)
            ->only(['store', 'update', 'destroy'])
            ->names([
                'store' => 'project.planning.criteria.store',
                'update' => 'project.planning.criteria.update',
                'destroy' => 'project.planning.criteria.destroy',
            ]);

        Route::put('/criteria/{criteriaId}/change-preselected', [CriteriaController::class, 'change_preselected'])
            ->name('project.planning.criteria.change-preselected');

        // Data Extraction Routes
        Route::prefix('/data-extraction/')->group(function () {

            Route::resource('/option', OptionController::class)
                ->only(['store', 'update', 'destroy'])
                ->names([
                    'store' => 'project.planning.data-extraction.option.store',
                    'update' => 'project.planning.data-extraction.option.update',
                    'destroy' => 'project.planning.data-extraction.option.destroy',
                ]);

            Route::resource('/question', QuestionController::class)
                ->only(['store', 'update', 'destroy'])
                ->names([
                    'store' => 'project.planning.data-extraction.question.store',
                    'update' => 'project.planning.data-extraction.question.update',
                    'destroy' => 'project.planning.data-extraction.question.destroy',
                ]);
        });
    });
    // End of the Planning Routes

    // start of the reporting routes
    Route::get('/reporting/', [ReportingController::class, 'index'])->name('reporting.index')->middleware('auth');
});


//Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::middleware(['locale', 'guest'])->group(function () {
    Route::get('/', [HomeController::class, 'guest_home'])->name('home');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
    Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
    Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
    Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
