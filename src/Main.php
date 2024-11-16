<?php

namespace lubro\ServerManager;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable(): void {
        if ($this->getServer()->getPluginManager()->getPlugin("FormAPI") !== null) {
            return;
        }
        $this->getServer()->getPluginManager()->disablePlugin($this);
    }
}
