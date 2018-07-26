## MyHammer Code Challenge

### Pre-Requisites

- Composer
- Docker
- Docker Compose

### Installation

Set configuration: `cp .env.dist .env`

Create log and cache folders: `mkdir -p var/cache & mkdir -p var/log`

Install application dependencies: `php composer.phar install`
 
Add `127.0.0.1 myhammer.vm` to `/etc/hosts`
 
Build images and start containers: `docker-composer up` (wait for containers start completely)

Create DB Schema: `docker-compose exec php ./bin/console doctrine:schema:create`

Load samples: `docker-compose exec php ./bin/console doctrine:fixtures:load -n`

### Running tests

`docker-compose exec php ./vendor/bin/behat`

### Requests examples

##### Request cities

```
curl -X GET \
  http://myhammer.vm:8080/city \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1'

```

##### Request city by zip code

```
curl -X GET \
  http://myhammer.vm:8080/city/zipcode/21521 \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1' 
```

##### Request categories

```
curl -X GET \
  http://myhammer.vm:8080/category \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1'

```

##### Request category

```
curl -X GET \
  http://myhammer.vm:8080/category/8813457d-3779-45b9-b46b-5ccd6cf4cb1b \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1' 
```

##### Request jobs

```
curl -X GET \
  http://myhammer.vm:8080/job \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1'

```

##### Request a job

```
curl -X GET \
  http://myhammer.vm:8080/job/b9596b68-fb7f-44a6-aba6-356f6fc5d11b \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1' 
```

##### Delete a job

```
curl -X DELETE \
  http://myhammer.vm:8080/job/b9596b68-fb7f-44a6-aba6-356f6fc5d11b \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1' 
```

##### Create a job

```
curl -X POST \
  'http://localhost:8000/job' \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1' \
  -d '{
	"title": "My job title 2",
	"description": "My job description 2",
	"city": "7e620927-3460-40a8-b092-20fded977a4e",
	"category": "dd9be6ae-ca72-446d-bf95-c3fec98fd30e",
	"executionDate": "2018-08-01"
}'
```

##### Update a job

```
curl -X PUT \
  'http://localhost:8000/job/b9596b68-fb7f-44a6-aba6-356f6fc5d11b' \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'X-Accept-Version: v1' \
  -d '{
	"title": "My job title 2",
	"description": "My job description 2",
	"city": "7e620927-3460-40a8-b092-20fded977a4e",
	"category": "dd9be6ae-ca72-446d-bf95-c3fec98fd30e",
	"executionDate": "2018-08-01"
}'
```
