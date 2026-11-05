<?php
use Illuminate\Support\Facades\Artisan;
Artisan::command('about-app', function () { $this->comment('F-01 Authentication & Admin Dashboard'); })->purpose('Display application information');
