Migrations
==========

Now generate the Laratrust migration::

    php artisan laratrust:migration

It will generate the ``<timestamp>_laratrust_setup_tables.php`` migration.
You may now run it with the artisan migrate command::

    php artisan migrate

After the migration, five (or six if you use teams feature) new tables will be present:

* ``roles`` — stores role records.
* ``permissions`` — stores permission records.
* ``teams`` — stores teams records (Only if you use the teams feature).
* ``role_user`` — stores `polymorphic <https://laravel.com/docs/eloquent-relationships#polymorphic-relations>`_ relations between roles and users.
* ``permission_role`` — stores `many-to-many <https://laravel.com/docs/eloquent-relationships#many-to-many>`_ relations between roles and permissions.
* ``permission_user`` — stores `polymorphic <https://laravel.com/docs/eloquent-relationships#polymorphic-relations>`_ relations between users and permissions.
