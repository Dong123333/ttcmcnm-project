<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $code_id;

    public function __construct($user, $code_id)
    {
        $this->user = $user;
        $this->code_id = $code_id;
    }

    public function build()
    {
        return $this->view('mails.verify')
                    ->with([
                        'user' => $this->user,
                        'code_id' => $this->code_id
                    ]);
                   
    }
}
