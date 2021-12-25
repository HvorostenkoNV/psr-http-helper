# PSR helper pack
### build and up all containers
```
cd docker
docker-compose up -d
```
### installation
###### go into PHP container
```
cd docker
docker exec -it psr-http-helper-php sh
```
###### run composer
```
composer install
```
### hotkeys
###### up all containers and get into php container
```
./up.sh
```
###### down all containers
```
./down.sh
```