<?php

namespace lubro\ServerManager;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use jojoe77777\FormAPI\Form;

class Main extends PluginBase {

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "servermanager") {
            if (!$sender instanceof Player) {
                $sender->sendMessage("This command can only be used in-game.");
                return true;
            }
            if (!$sender->hasPermission("servermanager.open")) {
                $sender->sendMessage("You do not have permission to use this command.");
                return true;
            }
            $this->sendServerManagerForm($sender);
            return true;
        }
        return false;
    }

    private function sendServerManagerForm(Player $player): void {
        $form = new class() extends Form {
            public function __construct(callable $callback) {
                $this->callback = $callback;
            }

            public function handleResponse(Player $player, $data): void {
                ($this->callback)($player, $data);
            }

            public function jsonSerialize(): array {
                $os = PHP_OS;
                return [
                    "type" => "form",
                    "title" => "Server Manager",
                    "content" => "Operating System: " . $os,
                    "buttons" => [
                        ["text" => "Close"]
                    ]
                ];
            }
        };

        $player->sendForm($form);
    }
}
