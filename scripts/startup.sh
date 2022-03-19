cp ./env.skel ./.env
mkdir ./logs/nginx
touch ./logs/nginx/access.log
touch ./logs/nginx/error.log
cp ./docker/php-fpm/xdebug-ini.skel ./docker/php-fpm/xdebug.ini