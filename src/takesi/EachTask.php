<?php

namespace takesi;

use pocketmine\scheduler\PluginTask;

use pocketmine\Server;
use pocketmine\utils\Config;

use takesi\main;

class EachTask extends PluginTask {

    public $plugin;

      public function __construct(Main $plugin) {
          parent::__construct($plugin);
          $this->plugin = $plugin;
      }

      public function getPlugin() {
          return $this->plugin;
      }

      public function onRun($tick) {
          $players = Server::getInstance()->getOnlinePlayers();
          $time = date("H:i:s",time());
          foreach ($players as $player) {
              
            if($player->hasEffect(14)){
                  $player->removeEffect(14); 
            }

            $player->sendPopup("INFO\n"."DATE : ".$time."\nYOUR POSITION : "."X>".$player->getX()." Y>".$player->getY()." Z>".$player->getZ() ."\nWORLD : ".$player->getlevel()->getName());
                
            if($player->getlevel()->getName() != $player->getName()){
				$this->config = new Config($this->getPlugin()->getDataFolder().$player->getlevel()->getName().".yml", Config::YAML);
				if($this->config->exists("invited_".$player->getName())){
					if($player->getGamemode() == 0){
                        $player->setGamemode(1);
                    }
				}else{
                    if($player->getGamemode() != 0){
                        $player->setGamemode(0);
                    }
                }
            }
        }
        //$this->getPlugin()->removeTask($this->getTaskId());
      }
}