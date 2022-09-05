<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Digunakan untuk pengisian data user ke table users secara random';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $password=Str::random(10);
        $email=Str::random(10).'@gmail.com';
        $user=User::create([
            'name'=>Str::random(10),
            'email'=>$email,
            'password'=>$password,
            'phone_number'=>'01923712489123',
            'role'=>'member'
        ]);
        return $this->info('Member user created. Credentials => Email '.$email. ' password '.$password);
    }
}
