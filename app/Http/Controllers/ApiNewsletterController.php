<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SendEmailVerificationReminderCommand;

class ApiNewsletterController extends Controller
{
    public function send()
    {
        Artisan::call(SendEmailVerificationReminderCommand::class);

        return response()->json([
            'data' => "Todo Correcto"
        ]);
    }

}
