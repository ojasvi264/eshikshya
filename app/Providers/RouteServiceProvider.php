<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $adminNamespace = 'App\Http\Controllers\Admin';
    protected $teacherNamespace = 'App\Http\Controllers\Teacher';
    protected $librarianNamespace = 'App\Http\Controllers\Librarian';
    protected $accountantNamespace = 'App\Http\Controllers\Accountant';
    protected $receptionistNamespace = 'App\Http\Controllers\Receptionist';
    protected $studentNamespace = 'App\Http\Controllers\Student';
    protected $parentNamespace = 'App\Http\Controllers\Parent';

    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    public const TEACHER_HOME = '/teacher/dashboard';
    public const LIBRARIAN_HOME = '/librarian/dashboard';
    public const ACCOUNTANT_HOME = '/accountant/dashboard';
    public const STUDENT_HOME = '/student/dashboard';
    public const ADMIN_HOME = '/admin/dashboard';
    public const PARENT_HOME = '/parent/dashboard';
    public const RECEPTIONIST_HOME = '/receptionist/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
//    public function boot()
//    {
//        $this->configureRateLimiting();
//        parent::boot();
//
//         $this->routes(function () {
//             Route::middleware('api')
//                 ->prefix('api')
//                 ->group(base_path('routes/api.php'));
//
//             Route::middleware('web')
//                 ->group(base_path('routes/web.php'));
//         });
//    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapTeacherRoutes();

        $this->mapAccountantRoutes();

        $this->mapLibrarianRoutes();

        $this->mapReceptionistRoutes();

        $this->mapStudentRoutes();

        $this->mapParentRoutes();

        $this->mapCommonRoutes();

        $this->mapSuperadminRoutes();

        $this->mapAccountRoutes();
    }


    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAccountantRoutes()
    {
           Route::middleware('web')
            ->namespace($this->accountantNamespace)
            ->group(base_path('routes/accountant.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapTeacherRoutes()
    {
           Route::middleware('web')
            ->namespace($this->teacherNamespace)
            ->group(base_path('routes/teacher.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapLibrarianRoutes()
    {
        Route::middleware('web')
            ->namespace($this->librarianNamespace)
            ->group(base_path('routes/librarian.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapReceptionistRoutes()
    {
        Route::middleware('web')
            ->namespace($this->receptionistNamespace)
            ->group(base_path('routes/receptionist.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapStudentRoutes()
    {
           Route::middleware('web')
            ->namespace($this->studentNamespace)
            ->group(base_path('routes/student.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapParentRoutes()
    {
           Route::middleware('web')
            ->namespace($this->parentNamespace)
            ->group(base_path('routes/parent.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapCustomRoutes()
    {
           Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/custom.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapCommonRoutes()
    {
           Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/common.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapSuperadminRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/superadmin.php'));
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAccountRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/account.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
