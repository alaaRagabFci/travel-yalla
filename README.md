# travel-yalla
- Install docker
- Run sudo docker-compose up -d
- Run sudo docker-compose exec web php composer update
- Run sudo docker-compose exec web php  artisan migrate --seed
- Run sudo docker-compose exec web php artisan passport:install
- Run sudo docker-compose exec web php artisan serve
- Change port to 8090
- http://127.0.0.1:8090
