<?php

namespace App\Http\Controllers;

use App\Events\MenuEvent;
use App\Models\Message;
use App\Models\User;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramController extends Controller
{
    public function __construct(private Api $telegram)
    {
    }

    public function webHook()
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
        MenuEvent::dispatch($chatId);
    }

    private function isCommandCorrect(string $command): bool
    {
        return (
            strpos($command, '/')
            && in_array($command, ['/menu'])
        );
    }
}
