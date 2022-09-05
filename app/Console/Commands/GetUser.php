<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

use Illuminate\Support\Facades\Artisan;

class GetUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:user {user_id=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ini dipakai untuk mendapatakan data user dari DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*$name=$this->ask('testing asking name');
        $password=$this->ask('testing asking password');
        return $this->info('nama adalah ' .$name.',password adalah ' .$password);*/

        //$userId=$this->argument('user_id');
        //return 0;
        $userId=$this->argument('user_id');
        $user=User::find($userId);
        if(!$user){
            return $this->error('User tidak ditemukan !');
        }

        return $this->info('Name '.$user->name);

        //panggil artisan lain
        //$tes=Artisan::call();
    }
}
