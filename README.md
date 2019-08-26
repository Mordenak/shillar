# laravel-adventure

First Phase:  Recreate Shilla + Creation Tools.

Second Phase: Branch off own project with custom changes based on Shilla.

Game Todo:

* ~~Proper combat attack differences~~
* ~~Death functions~~
* ~~Shops~~
* Quests
* ~~Bank~~
* ~~Forge~~
* ~~Traders~~
* Directional blocks, NPCs/locks -- Working?
* ~~Kill tracking~~
* Spells
* ~~Wall score ranks~~
* Online character listing
* Full admin tools
* Items on ground stack
* ~~Add Consider feature~~
* ~~Scramble Combat buttons~~
* Light levels
* Environmental Heat/Cold
* Add Tutorial back in?
* Encumbrance?  Probably not.


Test bed: http://laravel-adventure.herokuapp.com/

Info pool: http://www.shillatime.org/shillatime.html

Code Todo:

* ~~Fix npc spawn on item pickup~~
* Move functions out of game controller
* Route admin functions through admin route with auth middleware admin level check
* ~~Fix Menu CSS/sizing~~
* ~~Debate: CharacterStats to Characters table???~~
* ~~Debate: InventoryItems to no quantity, count of records.~~
* Fix stats page refresh killing intervals for rest/combat.
* Button up security on preventing macros.  
* Drop equipment on death
* Make stats on equipment apply
* Fix inline JS/CSS
* Fix Menu view usage, currently in main & partials.
* Fix Character listings within rooms to be only online characters (currently is all characters)