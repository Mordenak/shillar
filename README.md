# laravel-adventure

First Phase:  Recreate Shilla + Creation Tools.

Second Phase: Branch off own project with custom changes based on Shilla.

Game Todo:

* ~~Proper combat attack differences~~
* ~~Death functions~~
* ~~Shops~~
* ~~Quests~~ Basic quest is there -- working?
* ~~Bank~~
* ~~Forge~~
* ~~Traders~~
* ~~Directional blocks, NPCs/locks~~ -- Working?
* ~~Kill tracking~~
* ~~Spell Training~~ [Partial]
* Spells
* ~~Wall score ranks~~
* Online character listing
* Full admin tools
* Items on ground stack
* ~~Add Consider feature~~
* ~~Scramble Combat buttons~~
* Support multiple layouts?
* Light levels
* Environmental Heat/Cold
* Add Tutorial back in?
* Encumbrance?  Probably not.
* Guilds?  Ehhhh.
* ~~Chat "Rooms" cause why not.~~


Test bed: http://laravel-adventure.herokuapp.com/

Info pool: http://www.shillatime.org/shillatime.html

Code Todo:

* BIG TODO: Add error checking/handling for lots of actions to reduce game errors.
* BIG TODO: Fix combat function so that it doesn't also manage the main view :/
* BIG TODO: Refactor some views/partials and combine them -- DRY!
* Actually implement the racial modifers
* ~~Fix broken combat after direction update!~~
* Improve performance
* ~~Fix broken trading~~
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
* For performance, possibly look into adding more flags to control when extra queries happen?
* Example of above would be a Room->has_quest flag to determine if we should check for a quest targeting the room