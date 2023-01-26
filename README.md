## How to set up the project.

### Using Docker
```bash
# Launch docker
cd docker
cp .env.example .env
docker-compose up -d
docker-compose exec app bash
# Initialization
cp .env.example .env
php artisan key:generate
composer install
php artisan migrate --seed
php artisan storage:link
# Setup passport
php artisan passport:install
# Open the .env file and edit the two variables PASSPORT_CLIENT_ID and PASSPORT_CLIENT_SECRET according to the content run by the command php artisan passport:install
```
