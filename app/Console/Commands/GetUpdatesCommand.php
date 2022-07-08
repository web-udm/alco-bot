<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;
use Telegram\Bot\Api;

class GetUpdatesCommand extends Command
{
    protected $signature = 'telegram:get_updates';

    protected $description = 'Command description';

    public function __construct(
        private Api $telegram
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        //$lastUpdateId = Message::
    }
}
