HillsModeling
===========

**Installation**

The first thing to do is to download the zip project or clone it with `git clone`


To download the dependencies, you need to install composer and run `composer install`.
At some point, you will be asked information about your database configuration.
If you get some errors after this, you will need to force the database creation.

For this, use `php app/console doctrine:database:create`
Then `php app/console doctrine:schema:update —force`
At last, install assets with `php app/console assets:install`
