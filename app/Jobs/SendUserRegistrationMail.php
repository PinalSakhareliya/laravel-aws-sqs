<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Common;
use Illuminate\Support\Facades\Log;


class SendUserRegistrationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $subject;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $subject)
    {
        //
        $this->data = $data;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Job start - send mail to user');
        $to = $this->data->email;
        $userName = $this->data->name;
        $html = "<p>Hi $userName,<p>
                <p>Thank you for registering with ABC! We’re thrilled to have you as part of our community. Feel free to log in anytime and start exploring all our features.</p>
                <p>If you have any questions, don’t hesitate to reach out!</p>
                <p>Thank you,<br>ABC Team</p>";

        $dataEmail = [
            'from' => 'Nerds <nerds@datarushportal.com>',
            'to'    => $to,
            'subject'  => $this->subject,
            'html' => $html
        ];

        // send mail
        Common::soundwaveCronEmail($dataEmail);

        Log::info('Job end - send mail to user');
    }
}
