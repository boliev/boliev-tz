Vladimir Boliev Test
====================
Requirements
------------
- PHP 7.1

Instalation
-----------
- firstly you need to clone this application to you local machine: ```git clone https://github.com/boliev/boliev-tz.git```
- change directory ```cd boliev-tz```
- install phpUnit and generate autoload file by composer ```composer install```
- change dir to `web` ```cd web```
- and start Built-in web server ```php -S 127.0.0.1:8000```
- type `http://127.0.0.1:8000` at your browser, you should get a message ```
{
    message: "The default route is useless. Try /api/v1/journey/"
}```

Usage
-----
To use app - send json with cards list to route `[POST] http://127.0.0.1:8000/api/v1/journey/`
I chose `POST` because in a real application we will put routes into some database.
JSON example: 
 ```
 [
 	{
 		"transport": "flight SK455",
 		"from": "Gerona Airport",
 		"to": "Stockholm",
 		"seat": "Gate 45B, seat 3A",
 		"info": "Baggage drop at ticket counter 344"
 	},
 	{
 		"transport": "train 78A",
 		"from": "Madrid",
 		"to": "Barcelona",
 		"seat": "Seat 45B"
 	},
 	{
 		"transport": "flight SK22",
 		"from": "Stockholm",
 		"to": "New York JFK",
 		"seat": "Gate 22, seat 7B",
 		"info": "Baggage will we automatically transferred from your last leg."
 	},
 	{
 		"transport": "airport bus",
 		"from": "Barcelona",
 		"to": "Gerona Airport"
 	}
 ]
 ```
 Also you can import Postman collection with the route by link  https://www.getpostman.com/collections/425c0bd5824497886d5f
 Or check out apiary documentation http://docs.bolievtest.apiary.io/
 
 To run Unit tests change dir to application root and run ```vendor/bin/phpunit tests/```
 
 Application Structure
 ---------------------
 - app
    - config
        - `dependency.php` - list of dependencies
        - `routes.php` - list of routes
        - `translates.php` - language constants
 - src
    - Controller
        - `AbstractApiController.php` - abstract controller for API routes. Extends of `AbstractController.php`
        - `AbstractController.php` - abstract controller
        - `DefaultController.php` - just a default controller
        - `JourneyController.php` - controller and action for `api/v1/journey/` route
    - Exception
    - Lib
        - `DependencyContainer.php` - simple dependency container
        - `Request.php` - request object
        - `Response.php` - response object
        - `Router.php` - simple implementation of a Front Controller pattern
        - `RouterRunner.php` - instantiate a controllers and executes an actions
        - `Translator.php` - simple translator
    - Service
        - `Cards.php` - service for works with cards
 - tests
    - lib
        `DependencyContainerTest.php` - unit tests for Dependency Container
        `RouterTest.php` - unit tests for Router
    - Service
        `CardsTest.php` - unit tests for Cards service
 - web
    - `index.php` - index file