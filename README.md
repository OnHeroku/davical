DAViCAL on Heroku
=================

First, we'll create an empty top-level directory for our project:

    $ mkdir hellodavical
    $ cd hellodavical

### Create git repository:

    $ git init

### Add submodules

    $ git submodule add https://github.com/DAViCal/davical.git
    $ git submodule add https://github.com/andrews-web-libraries/awl.git
    $ git commit -m "Add submodules"

### index.php

    $ touch index.php
    $ git add index.php
    $ git commit -m "Add index.php"

### httpd.conf

    $ wget https://github.com/OnHeroku/davical/raw/master/httpd.conf
    $ git add httpd.conf
    $ git commit -m "Add httpd.conf"

### config.php

    $ wget https://github.com/OnHeroku/davical/raw/master/config.php
    $ git add config.php
    $ git commit -m "Add config.php"

### .profile

    $ wget https://github.com/OnHeroku/davical/raw/master/.profile
    $ git add .profile
    $ git commit -m "Add .profile"

### Procfile

    $ wget https://github.com/OnHeroku/davical/raw/master/Procfile
    $ git add Procfile
    $ git commit -m "Add Procfile"

### calendar.so

    $ wget https://github.com/OnHeroku/davical/raw/master/calendar.so
    $ git add calendar.so
    $ git commit -m "Add calendar.so"

### gettext.so

    $ wget https://github.com/OnHeroku/davical/raw/master/gettext.so
    $ git add gettext.so
    $ git commit -m "Add gettext.so"

### php.ini

    $ wget https://github.com/OnHeroku/davical/raw/master/php.ini
    $ git add php.ini
    $ git commit -m "Add php.ini"

### Deploy your application to Heroku

The next step is to push this repository to Heroku. First, we have to get a place to push to from Heroku. We can do this with the `heroku create` command:

    $ heroku create

This automatically added the Heroku remote for our app to our repository. Now we can do a simple git push to deploy our application:

    $ git push heroku master

### Create database

Heroku Postgres can be attached to a Heroku application via the CLI:

    $ heroku addons:add heroku-postgresql:dev

Heroku recommends using the `DATABASE_URL` config variable to store the location of your primary database. In single-database setups your new database will have already been assigned a `HEROKU_POSTGRESQL_COLOR_URL` config variable but must be promoted to have its location set in the `DATABASE_URL`:

    $ heroku pg:promote HEROKU_POSTGRESQL_COLOR_URL

### Setup database

    $ heroku pg:psql < awl/dba/awl-tables.sql
    $ heroku pg:psql < awl/dba/schema-management.sql
    $ heroku pg:psql < davical/dba/davical.sql
    $ heroku pg:psql < davical/dba/base-data.sql
    $ heroku pg:psql < davical/dba/caldav_functions.sql
    $ heroku pg:psql < davical/dba/views/dav_principal.sql
    $ echo "UPDATE usr SET password = '**changeme' WHERE user_no = 1;" | heroku pg:psql

### Conclusion

We can now restart the app and then visit it in our browser:

    $ heroku restart
    $ heroku open

Have fun!
