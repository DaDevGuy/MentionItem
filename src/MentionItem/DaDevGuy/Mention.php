<?php
declare(strict_types=1);

namespace MentionItem\DaDevGuy;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Mention extends PluginBase implements Listener {
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function bragChat(PlayerChatEvent $event){
        $player = $event->getPlayer();
        $itemBrag = $player->getInventory()->getItemInHand();
        $name = $itemBrag->getName();
        if($itemBrag->hasCustomName()){
            $name = $itemBrag->getCustomName();
        }
        $replace = TextFormat::YELLOW . ">> " . TextFormat::GRAY . $name ." " . TextFormat::GRAY . "(x" . $itemBrag->getCount() . ")" . TextFormat::YELLOW . " <<" . TextFormat::RESET;
        $message = $event->getMessage();
        $message = str_replace("[item]", $replace, $message);
        $event->setMessage($message);
    }
}