<?php

namespace Jxlwqq\Quill;

use Illuminate\Support\ServiceProvider;
use Encore\Admin\Admin;
use Encore\Admin\Form;

class QuillServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Quill $extension)
    {
        if (!Quill::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-quill');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/quill')],
                'laravel-admin-quill'
            );
        }

        Admin::booting(function () {
            Form::extend('quill', Editor::class);
        });
    }
}