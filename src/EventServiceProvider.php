<?php
namespace Tir\Menu;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Tir\Crud\Events\GetCrudEvent;
use Tir\Menu\Listeners\AddFieldListener;


class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the Acl Package.
     *
     * @var array
     */
    protected $listen = [
        GetCrudEvent::class => [
            AddFieldListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
