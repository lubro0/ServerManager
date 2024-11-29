<?php

namespace lubro\ServerManager;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;

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
        $form = new SimpleForm(function (Player $player, $data) {
        });
        $form->setTitle("Server Manager");
        $form->setContent("Operating System: " . PHP_OS);
        $form->addButton("Close");
        $player->sendForm($form);
    }
}
