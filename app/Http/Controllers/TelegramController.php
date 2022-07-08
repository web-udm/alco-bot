<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function webHook(Api $telegram)
    {
        dd($telegram->getUpdates());
    }
}
