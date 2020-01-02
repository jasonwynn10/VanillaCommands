<?php

namespace DenielWorld\VanillaCommands\utils;

class SoundManager {
	//IMPORTANT TODO - Not all the sounds were implemented, since there was too many vanilla sounds, and I got bored entering the same thing over and over lol. In other words, PRs that will complete the const list, const array, name array, const string array, and ids array are welcome and very appreciated :D. The list for the leftover sounds ends at the bottom, make sure to follow the same array relation for appropriate sounds. Example: in const array key 67 could be RANDOM_SOUND, that means in other arrays key 67 should also point to that sound, such as in names array it would be kind of like "random.sound". Hope you get the point.

	CONST IDS = ["beacon.power" => -1, "unknown.sound" => 0, "ambient.weather.lightning.impact" => 1, "ambient.weather.rain" => 2, "ambient.weather.thunder" => 3, "armor.equip_chain" => 4, "armor.equip_diamond" => 5, "armor.equip_generic" => 6, "armor.equip_gold" => 7, "armor.equip_iron" => 8, "armor.equip_leather" => 9, "beacon.activate" => 10, "beacon.ambient" => 11, "beacon.deactivate" => 12, "block.bamboo.break" => 13, "block.bamboo.fall" => 14, "block.bamboo.hit" => 15, "block.bamboo.place" => 16, "block.bamboo.step" => 17, "block.bamboo_sapling.break" => 18, "block.bamboo_sapling.place" => 19, "block.barrel.close" => 20, "block.barrel.open" => 21, "block.bell.hit" => 22, "block.campfire.crackle" => 23, "block.chorusflower.death" => 24, "block.chorusflower.grow" => 25, "block.composter.empty" => 26, "block.composter.fill" => 27, "block.composter.fill_success" => 28, "block.composter.ready" => 29, "block.end_portal.spawn" => 30];

	public function isValidId(int $id) : bool {
		return in_array($id, self::IDS);
	}

	public function isValidName(string $name) : bool {
		return in_array($name, array_keys(self::IDS));
	}

	public function getNameFromId(int $soundId) : ?string {
		$key = array_search($soundId, self::IDS);
		if($key !== false) {
			return $key;
		}
		return null;
	}

	public function getIdFromName(string $soundName) : ?int {
		if(isset(self::IDS[$soundName])) {
			return self::IDS[$soundName];
		}
		return null;
	}

	/*
Todo - Add the rest of the vanilla sounds from this list. Feel free to PR these if you know what ur doing.
block.end_portal_frame.fill
block.false_permissions
block.grindstone.use
block.itemframe.add_item
block.itemframe.break
block.itemframe.place
block.itemframe.remove_item
block.itemframe.rotate_item
block.lantern.break
block.lantern.fall
block.lantern.hit
block.lantern.place
block.lantern.step
block.scaffolding.break
block.scaffolding.climb
block.scaffolding.fall
block.scaffolding.hit
block.scaffolding.place
block.scaffolding.step
block.sweet_berry_bush.break
block.sweet_berry_bush.hurt
block.sweet_berry_bush.pick
block.sweet_berry_bush.place
block.turtle_egg.break
block.turtle_egg.crack
block.turtle_egg.drop
bottle.dragonbreath
bubble.down
bubble.downinside
bubble.pop
bubble.up
bubble.upinside
bucket.empty_fish
bucket.empty_lava
bucket.empty_water
bucket.fill_fish
bucket.fill_lava
bucket.fill_water
camera.take_picture
cauldron.adddye
cauldron.cleanarmor
cauldron.cleanbanner
cauldron.dyearmor
cauldron.explode
cauldron.fillpotion
cauldron.fillwater
cauldron.takepotion
cauldron.takewater
conduit.activate
conduit.ambient
conduit.attack
conduit.deactivate
conduit.short
crossbow.loading.middle
crossbow.loading.start
crossbow.quick_charge.end
crossbow.quick_charge.middle
crossbow.quick_charge.start
crossbow.shoot
damage.fallbig
damage.fallsmall
damage.thorns
dig.cloth
dig.grass
dig.gravel
dig.sand
dig.snow
dig.stone
dig.wood
elytra.loop
fall.anvil
fall.cloth
fall.egg
fall.grass
fall.gravel
fall.ladder
fall.sand
fall.slime
fall.snow
fall.stone
fall.wood
fire.fire
fire.ignite
firework.blast
firework.large_blast
firework.launch
firework.shoot
firework.twinkle
game.player.attack.nodamage
game.player.attack.strong
game.player.die
game.player.hurt
hit.anvil
hit.cloth
hit.grass
hit.gravel
hit.ladder
hit.sand
hit.slime
hit.snow
hit.stone
hit.wood
item.book.put
item.shield.block
item.trident.hit
item.trident.hit_ground
item.trident.return
item.trident.riptide_1
item.trident.riptide_2
item.trident.riptide_3
item.trident.throw
item.trident.thunder
jump.anvil
jump.cloth
jump.grass
jump.gravel
jump.ladder
jump.metal
jump.sand
jump.slime
jump.snow
jump.stone
jump.wood
land.anvil
land.cloth
land.grass
land.gravel
land.ladder
land.sand
land.slime
land.snow
land.stone
land.wood
leashknot.break
leashknot.place
liquid.lava
liquid.lavapop
liquid.water
minecart.base
minecart.inside
mob.armor_stand.break
mob.armor_stand.hit
mob.armor_stand.land
mob.armor_stand.place
mob.attack
mob.bat.death
mob.bat.hurt
mob.bat.idle
mob.bat.takeoff
mob.blaze.ambient
mob.blaze.breathe
mob.blaze.death
mob.blaze.hit
mob.blaze.shoot
mob.cat.eat
mob.cat.hiss
mob.cat.hit
mob.cat.meow
mob.cat.purr
mob.cat.purreow
mob.cat.straymeow
mob.chicken.hurt
mob.chicken.plop
mob.chicken.say
mob.chicken.step
mob.cow.hurt
mob.cow.milk
mob.cow.say
mob.cow.step
mob.creeper.death
mob.creeper.say
mob.dolphin.attack
mob.dolphin.blowhole
mob.dolphin.death
mob.dolphin.eat
mob.dolphin.hurt
mob.dolphin.idle
mob.dolphin.idle_water
mob.dolphin.jump
mob.dolphin.splash
mob.dolphin.swim
mob.drowned.death
mob.drowned.death_water
mob.drowned.hurt
mob.drowned.hurt_water
mob.drowned.say
mob.drowned.say_water
mob.drowned.step
mob.elderguardian.curse
mob.elderguardian.death
mob.elderguardian.hit
mob.elderguardian.idle
mob.enderdragon.death
mob.enderdragon.flap
mob.enderdragon.growl
mob.enderdragon.hit
mob.endermen.death
mob.endermen.hit
mob.endermen.idle
mob.endermen.portal
mob.endermen.scream
mob.endermen.stare
mob.endermite.hit
mob.endermite.kill
mob.endermite.say
mob.endermite.step
mob.evocation_fangs.attack
mob.evocation_illager.ambient
mob.evocation_illager.cast_spell
mob.evocation_illager.death
mob.evocation_illager.hurt
mob.evocation_illager.prepare_attack
mob.evocation_illager.prepare_summon
mob.evocation_illager.prepare_wololo
mob.fish.flop
mob.fish.hurt
mob.fish.step
mob.ghast.affectionate_scream
mob.ghast.charge
mob.ghast.death
mob.ghast.fireball
mob.ghast.moan
mob.ghast.scream
mob.guardian.ambient
mob.guardian.attack_loop
mob.guardian.death
mob.guardian.flop
mob.guardian.hit
mob.guardian.land_death
mob.guardian.land_hit
mob.guardian.land_idle
mob.horse.angry
mob.horse.armor
mob.horse.breathe
mob.horse.death
mob.horse.donkey.angry
mob.horse.donkey.death
mob.horse.donkey.hit
mob.horse.donkey.idle
mob.horse.eat
mob.horse.gallop
mob.horse.hit
mob.horse.idle
mob.horse.jump
mob.horse.land
mob.horse.leather
mob.horse.skeleton.death
mob.horse.skeleton.hit
mob.horse.skeleton.idle
mob.horse.soft
mob.horse.wood
mob.horse.zombie.death
mob.horse.zombie.hit
mob.horse.zombie.idle
mob.husk.ambient
mob.husk.death
mob.husk.hurt
mob.husk.step
mob.illusion_illager.ambient
mob.irongolem.death
mob.irongolem.hit
mob.irongolem.say
mob.irongolem.throw
mob.irongolem.walk
mob.llama.angry
mob.llama.death
mob.llama.eat
mob.llama.hurt
mob.llama.idle
mob.llama.spit
mob.llama.step
mob.llama.swag
mob.magmacube.big
mob.magmacube.jump
mob.magmacube.small
mob.ocelot.death
mob.ocelot.idle
mob.panda.bite
mob.panda.cant_breed
mob.panda.death
mob.panda.eat
mob.panda.hurt
mob.panda.idle
mob.panda.idle.aggressive
mob.panda.idle.worried
mob.panda.presneeze
mob.panda.sneeze
mob.panda.step
mob.panda_baby.idle
mob.parrot.death
mob.parrot.eat
mob.parrot.fly
mob.parrot.hurt
mob.parrot.idle
mob.parrot.step
mob.phantom.bite
mob.phantom.death
mob.phantom.hurt
mob.phantom.idle
mob.phantom.swoop
mob.pig.boost
mob.pig.death
mob.pig.say
mob.pig.step
mob.pillager.death
mob.pillager.hurt
mob.pillager.idle
mob.polarbear.death
mob.polarbear.hurt
mob.polarbear.idle
mob.polarbear.step
mob.polarbear.warning
mob.polarbear_baby.idle
mob.rabbit.death
mob.rabbit.hop
mob.rabbit.hurt
mob.rabbit.idle
mob.ravager.ambient
mob.ravager.bite
mob.ravager.death
mob.ravager.hurt
mob.ravager.roar
mob.ravager.step
mob.ravager.stun
mob.sheep.say
mob.sheep.shear
mob.sheep.step
mob.shulker.ambient
mob.shulker.bullet.hit
mob.shulker.close
mob.shulker.close.hurt
mob.shulker.death
mob.shulker.hurt
mob.shulker.open
mob.shulker.shoot
mob.shulker.teleport
mob.silverfish.hit
mob.silverfish.kill
mob.silverfish.say
mob.silverfish.step
mob.skeleton.death
mob.skeleton.hurt
mob.skeleton.say
mob.skeleton.step
mob.slime.attack
mob.slime.big
mob.slime.death
mob.slime.hurt
mob.slime.jump
mob.slime.small
mob.slime.squish
mob.snowgolem.death
mob.snowgolem.hurt
mob.snowgolem.shoot
mob.spider.death
mob.spider.say
mob.spider.step
mob.squid.ambient
mob.squid.death
mob.squid.hurt
mob.stray.ambient
mob.stray.death
mob.stray.hurt
mob.stray.step
mob.turtle.ambient
mob.turtle.death
mob.turtle.hurt
mob.turtle.step
mob.turtle.swim
mob.turtle_baby.born
mob.turtle_baby.death
mob.turtle_baby.hurt
mob.turtle_baby.step
mob.vex.ambient
mob.vex.charge
mob.vex.death
mob.vex.hurt
mob.villager.death
mob.villager.haggle
mob.villager.hit
mob.villager.idle
mob.villager.no
mob.villager.yes
mob.vindicator.death
mob.vindicator.hurt
mob.vindicator.idle
mob.witch.ambient
mob.witch.death
mob.witch.drink
mob.witch.hurt
mob.witch.throw
mob.wither.ambient
mob.wither.break_block
mob.wither.death
mob.wither.hurt
mob.wither.shoot
mob.wither.spawn
mob.wolf.bark
mob.wolf.death
mob.wolf.growl
mob.wolf.hurt
mob.wolf.panting
mob.wolf.shake
mob.wolf.step
mob.wolf.whine
mob.zombie.converted_to_drowned
mob.zombie.death
mob.zombie.hurt
mob.zombie.remedy
mob.zombie.say
mob.zombie.step
mob.zombie.unfect
mob.zombie.wood
mob.zombie.woodbreak
mob.zombie_villager.death
mob.zombie_villager.hurt
mob.zombie_villager.say
mob.zombiepig.zpig
mob.zombiepig.zpigangry
mob.zombiepig.zpigdeath
mob.zombiepig.zpighurt
music.game
music.game.creative
music.game.credits
music.game.end
music.game.endboss
music.game.nether
music.menu
note.bass
note.bassattack
note.bd
note.harp
note.hat
note.pling
note.snare
portal.portal
portal.travel
portal.trigger
raid.horn
random.anvil_break
random.anvil_land
random.anvil_use
random.bow
random.bowhit
random.break
random.burp
random.chestclosed
random.chestopen
random.click
random.door_close
random.door_open
random.drink
random.eat
random.enderchestclosed
random.enderchestopen
random.explode
random.fizz
random.fuse
random.glass
random.hurt
random.levelup
random.orb
random.pop
random.pop2
random.potion.brewed
random.shulkerboxclosed
random.shulkerboxopen
random.splash
random.swim
random.toast
random.totem
record.11
record.13
record.blocks
record.cat
record.chirp
record.far
record.mall
record.mellohi
record.stal
record.strad
record.wait
record.ward
step.anvil
step.cloth
step.grass
step.gravel
step.ladder
step.sand
step.slime
step.snow
step.stone
step.wood
tile.piston.in
tile.piston.out
ui.cartography_table.take_result
ui.loom.take_result
ui.stonecutter.take_result
use.anvil
use.cloth
use.grass
use.gravel
use.ladder
use.sand
use.slime
use.snow
use.stone
use.wood
vr.stutterturn*/
}