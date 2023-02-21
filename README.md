
# Docerized Recrutation task - GraphQl api in Symfony

This project contains dockerized simple CRUDE GraphQl api build in Symfony framework according to recrutation task.


## Installation

For installation go to your directory and clone repository:

```bash
$ git clone https://github.com/KubelP/dokcerized_recrutation_task.git
```

Go to directory recrutation_task:

```bash
$ cd recrutation_task
```

Set database in .env file (in recruraruon_task directory) as follows: 

        DATABASE_URL="mysql://root:secret@database_docker:3306/car_brand?serverVersion=8.0"

Build containers:

```bash
$ docker-compose up -d --build
```

With running docker containers open container with php:

```bash
$ docker exec -it php_docker /bin/bash
```

and then run composer inside container:

```bash
$ composer install
```

Inside container push migrations:

```bash
$ php bin/console doctrine:migrations:migrate
```

## Starting app

In browser go to `http://127.0.0.1:8080/graphiql` or send query for example: `http://127.0.0.1:8080/?query={carbrand(id:%221%22){brand_name%20year}}`

Api can create, read, update and delete data from database.  
It has three fields:
- id - prmiary key - intiger or string
- brandname - name of the car brand - string
- year - year of established of car brand - intiger

All fields are non-nullable.

## Endpoints

`http://127.0.0.1:8080/`

`http://127.0.0.1:8080/graphiql`

Graphiql endpoint is aviable only in dev mode.

## Tests enviroment

Comment in `docker-compose.yml` line in mysql service with volume (line 14-15). Save it and restart docker containers (that will remove existing db). 

Set database in .env.test as follows:

        DATABASE_URL="mysql://root:secret@database_docker:3306/car_brand?serverVersion=8.0"

With running docker containers open container with php:

```bash
$ docker exec -it php_docker /bin/bash
```

If previous db still exist restart containers again.

Make migration:

```bash
$ php bin/console doctrine:migrations:migrate
```

Run test by typing in console:

```bash
$ bin/phpunit
```

For run tests again due to auto increment of primary key (id) in database, it is necessary to create new database. If 14-15 line in docker-compose.yml is commented only need to restart docker containers. 

## Queries using GraphiQl

Examples of queries used in graphiql:

```json
mutation RootMutation {
    updateCarBrand(id:2, carbrand: {
        brand_name:"Bentley"
        year: 1919
    }) {
	    id
        brand_name
        year
	}
}
```

```json
mutation RootMutation {
    createCarBrand(carbrand: {
        brand_name:"Maserati"
        year:1900
    }) {
 	    id
        brand_name
        year
    }
}
```

```json
mutation RootMutation {
    deleteCarBrand(id:2) {
 	    id
    }
}
```

```json
query RootQuery {
    carbrand(id:1) {
        brand_name
        year
    }

    carbrands {
        id
        brand_name
        year
    }
}
```