<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Http\Livewire\AssessmentManager;
use App\Http\Livewire\GradingComponents;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('assessment-manager', AssessmentManager::class);
        Livewire::component('grading-components', GradingComponents::class);
    }

    public function register()
    {
        //
    }
}