<?php

namespace App\Console\Commands;

use App\Events\MenuEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

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

    public function handle(): void
    {
        $lastUpdateMessage = Message::latest('update_id')->first();
        $lastUpdateId = is_null($lastUpdateMessage) ? 1 : $lastUpdateMessage->update_id;

        $updates = $this->telegram->getUpdates(['offset' => $lastUpdateId + 1]);

        $messages = array_map(
            function (Update $update) {
                $user = User::firstOrCreate([
                    'username' => $update->getChat()->get('username'),
                    'chat_id' => $update->getChat()->id
                ]);

                $message = new Message([
                    'update_id' => $update->updateId,
                    'text' => $update->getMessage()->text
                ]);

                $user->messages()->save($message);

                return $message;
            },
            $updates
        );

        foreach ($messages as $message) {
            $this->processCommand($message->text, $message->user->chat_id);
        }
    }

    private function processCommand(string $command, int $chatId)
    {
        if ($this->isCommandCorrect($command)) {
            if ($command === '/menu') {
                 MenuEvent::dispatch($chatId);
            }
        }
    }

    private function isCommandCorrect(string $command): bool
    {
        return (
            str_contains($command, '/')
            && in_array($command, ['/menu'])
        );
    }
}
