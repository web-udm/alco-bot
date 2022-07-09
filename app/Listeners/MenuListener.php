<?php

namespace App\Listeners;

use App\Events\MenuEvent;
use App\Models\Cocktail;
use Telegram\Bot\Api;

class MenuListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private Api $telegram)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param MenuEvent $event
     * @return void
     */
    public function handle(MenuEvent $event)
    {
        $cocktails = Cocktail::all();

        $message = $cocktails->reduce(function ($message, Cocktail $cocktail) {
            $message .= ("\n\u{1F379} " . mb_strtoupper($cocktail->name) . "\n");
            $ingredients = json_decode($cocktail->ingredients, true);

            foreach ($ingredients['ingredients'] as $ingredient) {
                $message .= "- $ingredient\n";
            }

            return $message;
        });

        $this->telegram->sendMessage([
            'chat_id' => $event->getChatId(),
            'text' => $message
        ]);
    }
}
