<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Cupon;
use App\Models\Product;
use App\Models\Product_photo;
use App\Models\Subcategory;
use App\Observers\BlameableObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Brand::class => [BlameableObserver::class],
        Category::class => [BlameableObserver::class],
        Cupon::class => [BlameableObserver::class],
        Product::class => [BlameableObserver::class],
        Product_photo::class => [BlameableObserver::class],
        Subcategory::class => [BlameableObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}