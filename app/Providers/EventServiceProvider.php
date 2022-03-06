<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


use App\Models\Education;
use App\Models\Skill;
use App\Models\Category;
use App\Models\Profession;
use App\Models\Role;

use App\Observers\SkillObserver;
use App\Observers\EducationObserver;
use App\Observers\CategoryObserver;
use App\Observers\RoleObserver;
use App\Observers\ProfessionObserver;



class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Skill::observe(SkillObserver::class);
        Education::observe(EducationObserver::class);
        Category::observe(CategoryObserver::class);
        Role::observe(RoleObserver::class);
        Profession::observe(ProfessionObserver::class);
    }
}
