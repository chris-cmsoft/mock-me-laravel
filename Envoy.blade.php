@servers(['web' => ['root@41.185.28.63']])


@task('deploy', ['on' => 'web'])
    cd /var/www/html/mockme/
    php artisan down
    git pull origin master
    composer install --no-dev
    php artisan migrate
    php artisan up
@endtask
