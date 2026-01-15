<?php

namespace App\Mail;

use App\Models\Artisan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArtisanApproved extends Mailable
{
    use Queueable, SerializesModels;

    public Artisan $artisan;

    public function __construct(Artisan $artisan)
    {
        $this->artisan = $artisan;
    }

    public function build(): self
    {
        return $this->subject('Your artisan account has been approved')
            ->view('emails.artisans.approved');
    }
}
