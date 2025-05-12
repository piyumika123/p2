<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupplierRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $supplier;

    public function __construct($supplier = null)
    {
        $this->supplier = $supplier;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Supplier Registration Confirmation')
                    ->view('emails.supplier_registered')
                    ->with(['supplier' => $this->supplier]);
    }
}
