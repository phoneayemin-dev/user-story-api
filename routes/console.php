<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Employee;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

Artisan::command('create-emp', function () {
    Employee::create([
        'name' => 'Phone Aye Min',
        'code' => 'emp-1001',
        'phone_no' => '8348484848'
    ]);
});

Artisan::command('create-user', function () {
    User::create([
        'name' => 'Phone Aye Min',
        'email' => 'pam@gmail.com',
        'password' => bcrypt('1234')
    ]);
});
