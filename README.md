# laravel-adventure

First Phase:  Recreate Shilla + Creation Tools.

Second Phase: Branch off own project with custom changes based on Shilla.

Game Todo:

* Finalize all necessary game data
	** Missing forges, guilds, quests & all zone/room properties
* Implement custom scripts to help alleviate zone/room property limitations?
* ~~Proper combat attack differences~~
* ~~Death functions~~
* ~~Shops~~
* ~~Quests~~ Basic quest is there -- working?
* ~~Bank~~
* ~~Forge~~
* ~~Traders~~
* ~~Directional blocks, Creatures/locks~~ -- Working?
* ~~Kill tracking~~
* ~~Spell Training~~ [Partial]
* Spells
* ~~Wall score ranks~~
* Online character listing
* Full admin tools
* ~~Items on ground stack~~
* ~~Add Consider feature~~
* ~~Scramble Combat buttons~~
* Support multiple layouts?
* Light levels
* ~~Environmental Heat/Cold~~
* Add Tutorial back in?
* Encumbrance?  Probably not.
* Guilds?  Ehhhh.
* ~~Chat "Rooms" cause why not.~~


Test bed: http://shillar.herokuapp.com/

Trello (replace code todo): https://trello.com/b/L7DaKlgm/dev-log

Resources: 
http://www.shillatime.org/shillatime.html
http://www.oocities.org/sotrin_gotr/shilla_index.html
http://shillahelpsite.wikidot.com/

New Environment Troubleshooting:

On Linux:

1. Get basic tools
	1. sudo apt-get install git
	2. sudo apt-get install php7.4
	3. sudo apt-get install composer
	4. sudo apt-get install php-ext (and possibly php-mbstring)
	5. sudo apt-get install postgresql
	6. sudo apt-get install php7.4-pgsql
2. git clone repo
3. composer install
4. cp .env.example .env   (OR touch .env but be prepared to fill out the env file yourself)
5. Setup database
	1. sudo -u postgres createuser "username"
	2. Create database, ex: createdb adventure
	3. Create role and/or modify ownership
	4. edit .env to have correct database info
	5. php artisan migrate
9. php artisan key:generate

Database Reload examples:
Windows:
	pg_restore -U adventure --no-acl --clean -d adventure <file>
	or
	pg_restore -U adventure -d adventure --no-owner <file>
Linux - pg_restore --no-acl --clean -d adventure <file>

Other Windows notes, composer might need to be updated like so:
php -d memory_limit=-1 C:\ProgramData\ComposerSetup\bin\composer.phar update

Code Todo:

* Debug the extra GET /game request that causes 405s
* BIG TODO: Add error checking/handling for lots of actions to reduce game errors.
* BIG TODO: Fix combat function so that it doesn't also manage the main view :/
* BIG TODO: Refactor some views/partials and combine them -- DRY!
* TODO: May consider refactoring all relation functions to return the builder, not the collection.
* Creature armor -- % or Flat?
* Actually implement the racial modifers
* ~~Fix broken combat after direction update!~~
* Improve performance
* ~~Fix broken trading~~
* ~~Fix creature spawn on item pickup~~
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
