<?php

namespace DenielWorld\VanillaCommands;

use DenielWorld\VanillaCommands\command\{Connect, ImmutableWorld, MobEvent, SetBlock, SetMaxPlayers, AlwaysDay, Ability, Clear, PlaySound, Tag};
use pocketmine\entity\EntityIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDespawnEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\level\Level;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Loader extends PluginBase implements Listener{
    //Storing mob events that shouldn't occur here
	protected $mobevents = [];

    //Legal mob events
    protected $legalmobevents = ["events_enabled", "minecraft:pillager_patrols_event", "minecraft:wandering_trader_event"];

    //Worlds that cannot have blocks broken or placed in them
	protected $immutable_worlds = [];

    //todo add this stuff to max player manager - unset($array[array_search($value, $array)]) p.s I don't remember what this is for and why I didn't do it as of 10/20/2019
    //todo move some stuff from here to a separate EventListener, this should be mainly for loading and initiating what the plugin has to do
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->registerAll("vanillacommands", [
            new Ability("ability", $this),
            new AlwaysDay("alwaysday", $this),
            new Clear("clear", $this),
            new Connect("connect", $this),
            new SetBlock("setblock", $this),
            new SetMaxPlayers("setmaxplayers", $this),
            new PlaySound("playsound", $this),
            new MobEvent("mobevent", $this),
            new ImmutableWorld("immutableworld", $this),
            new Tag("tag", $this)
        ]);
    }

    public function getMobEvents(){
        return $this->mobevents;
    }

    public function getLegalMobEvents(){
        return $this->legalmobevents;
    }

    public function addMobEvent(string $mobevent) : void{
        foreach($this->legalmobevents as $legalmobevent) {
            if ($mobevent == $legalmobevent){
                array_push($this->mobevents, $mobevent);
            }
        }
    }

    public function removeMobEvent(string $mobevent) : void{
        foreach($this->legalmobevents as $legalmobevent) {
            if ($mobevent == $legalmobevent){
                $index = array_search($mobevent, $this->mobevents);
                if($index !== false){
                    unset($this->mobevents[$index]);
                }
            }
        }
    }

    //Will be used in the future for none vanilla features that make the already existing commands better
    public function isAdvancedVanilla() : bool{
        $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        if($cfg->get("advanced-vanilla") == true){
            return true;
        }
        else {
            return false;
        }
    }

    public function getImmutableWorlds(){
        return $this->immutable_worlds;
    }

    public function addImmutableWorld(string $level){
	    if(!in_array($level, $this->immutable_worlds)){
		    $this->immutable_worlds[] = $level;
	    }
    }

    public function removeImmutableWorld(string $level){
        if($this->getServer()->getLevelByName($level) instanceof Level){
            if(in_array($level, $this->immutable_worlds)){
                $index = array_search($level, $this->immutable_worlds);
                unset($this->immutable_worlds[$index]);
            }
        }
    }

    public function chatWhenMuted(PlayerChatEvent $event){
        if($event->getPlayer()->hasPermission("vanillacommands.state") or $event->getPlayer()->hasPermission("vanillacommands.state.mute")){
            $event->setCancelled();
        }
    }

    public function placeWhenNotWorldBuilder(BlockPlaceEvent $event){
        if($event->getPlayer()->hasPermission("vanillacommands.state") or $event->getPlayer()->hasPermission("vanillacommands.state.worldbuilder")) {
            $event->setCancelled();
        }
    }

    public function breakWhenNotWorldBuilder(BlockBreakEvent $event){
        if($event->getPlayer()->hasPermission("vanillacommands.state") or $event->getPlayer()->hasPermission("vanillacommands.state.worldbuilder")) {
            $event->setCancelled();
        }
    }
    public function flyingWhenCantFly(PlayerMoveEvent $event){
        if($event->getPlayer()->hasPermission("vanillacommands.state") or $event->getPlayer()->hasPermission("vanillacommands.state.mayfly")) {
            if($event->getPlayer()->isFlying()){
                $event->getPlayer()->setFlying(false);
            }
        }
    }

    public function mobSpawnEvent(EntitySpawnEvent $event){
        if(in_array("events_enabled", $this->mobevents)) $event->setCancelled();
    }

    public function mobDespawnEvent(EntityDespawnEvent $event){
        if(in_array("events_enabled", $this->mobevents)) $event->setCancelled();
    }

    public function pillagerEvent(EntitySpawnEvent $event){
        if($event->getEntity()->getId() === EntityIds::VINDICATOR or $event->getEntity()->getId() === EntityIds::EVOCATION_ILLAGER){
            if(in_array("minecraft:pillager_patrols_event", $this->mobevents)) $event->setCancelled();
        }
    }

    public function traderEvent(EntitySpawnEvent $event){
        if($event->getEntity()->getNameTag() === "Wandering Trader"){//Wandering trader id ain't even implemented in PMMP, gotta use a name dependency until/for future PMMP updates.
            if(in_array("minecraft:wandering_trader_event", $this->mobevents)) $event->setCancelled();
        }
    }

    public function immutableBlockPlace(BlockPlaceEvent $event){
        if(in_array($event->getPlayer()->getLevel()->getName(), $this->immutable_worlds)){
            $event->setCancelled();
        }
    }

    public function immutableBlockBreak(BlockBreakEvent $event){
        if(in_array($event->getPlayer()->getLevel()->getName(), $this->immutable_worlds)){
            $event->setCancelled();
        }
    }

    public function onFirstJoin(PlayerJoinEvent $event){
        if(!$event->getPlayer()->hasPlayedBefore()){
            $player_data = new Config($this->getDataFolder() . "player_data.yml", Config::YAML);
            $player_data->setNested($event->getPlayer()->getLowerCaseName() . ".tags", ["default-tag"]);
        }
    }
}