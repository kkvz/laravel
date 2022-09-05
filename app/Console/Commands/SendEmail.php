<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailTest;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim Email Testing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mailTo=$this->ask('Email ke');
        mail::to($mailTo)->send(new EmailTest($mailTo));
        return $this->info('email send to '.$mailTo);
    }
}
