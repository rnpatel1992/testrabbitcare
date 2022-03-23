# URL Shortener Service

The code in this repo runs on open source laravel application in a docker container 

## Installation

To get started, make sure you have [Docker](https://www.docker.com/get-started/) installed on your system, and then clone this repository.

1. Clone this project:

   ```sh
   git clone https://github.com/rnpatel1992/testrabbitcare.git
   ```

3. Build the project whit the next commands:

   ```sh
   docker-compose up -d --build
   ```

2. Inside the folder `public_html` and Generate your own `.env` to docker compose with the next command:

   ```sh
   cd public_html
   cp .env.example .env
   ```

3. run composer install:

   ```sh
   docker-compose exec php composer install
   ```

3. run migration to setup database:

   ```sh
   docker-compose exec php php artisan migrate
   ```


4. That's It !, Now you can access the project on [http://localhost:8088/](http://localhost:8088/)


## REST APIs

You can test/see all the api with detail information on postman by joining workspace using the below link 

[https://app.getpostman.com/join-team?invite_code=3f64e27a0dd7ff9531c22482fab1ad9e&target_code=ececc7b261438c4b99349ec70787899a](https://app.getpostman.com/join-team?invite_code=3f64e27a0dd7ff9531c22482fab1ad9e&target_code=ececc7b261438c4b99349ec70787899a)

Please follow below postman collection documentation for APIs.

API Base URL:

```dotenv
API_URL : http://localhost:8088/
```

### Client Api Documentation

Postman Documentation URL : [https://documenter.getpostman.com/view/10512621/UVsSNPaF](https://documenter.getpostman.com/view/10512621/UVsSNPaF)

API Authentication :

```dotenv
Authentication type : API key

key : apitoken
value: API_TOKEN (Token has been defined in .env)
```



### Admin Api  Documentation

Postman Documentation URL : [https://documenter.getpostman.com/view/10512621/UVsSN3ZJ](https://documenter.getpostman.com/view/10512621/UVsSN3ZJ)

API Authentication :

```dotenv
Authentication type : API key

key : apitoken
value: ADMIN_API_TOKEN (Token has been defined in .env)
```
