<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Post::class, PostPolicy::class);
        
        RateLimiter::for('register_login', function (Request $request) {
        return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip());});
        RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(10)->by($request->user()->id);});
        
    }
}
