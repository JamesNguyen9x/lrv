<?php

namespace App\Repositories\Mail;

use App\Repositories\BaseRepository;
use App\Repositories\Mail\MailInterface;

use Mail;

class MailRepository implements MailInterface{

    public function __construct() {
        
    }

    public function send($template, $data=[], $from=null, $to, $subject, $fromname=null, $toname=null) {
        Mail::send($template, ['data' => $data], function ($message) use ($to, $subject) {
            $message->to($to, 'VATC SleepPod')->from('jamesnguyen.kst@gmail.com')->subject($subject);
        });
    }
}

