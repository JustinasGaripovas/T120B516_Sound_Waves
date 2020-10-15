# T120B516_Sound_Waves

## Installation

### Repository setup
Clone repository
* `git clone https://github.com/JustinasGaripovas/T120B516_Sound_Waves.git`
Go to repository folder
* `cd T120B516_Sound_Waves/`

### Install composer dependancies
* `composer install --no-interaction`

### Update .env file
* Add your mysql connection credentials etc.
* Example `DATABASE_URL=mysql://MYSQL_USERNAME:MYSQL_PASSWORD@127.0.0.1:3306/DATABASE_NAME?serverVersion=5.7`

### Prepare database

If there is no database initialized do:
* `bin/console doctrine:database:create`
* `bin/console doctrine:migrations:migrate` 

### Prepare frontend 
* `npm install`
* `npm install @symfony/webpack-encore --save-dev`
* `npm run dev`
* `npm run watch`

### Running the app

* `symfony serve`

### Documentation
[API documentation](http://localhost:8000/api)
## General rules
* We follow [Semantic commit message guides](https://gist.github.com/joshbuchea/6f47e86d2510bce28f8e7f42ae84c716) when commiting
* We branch out from master to complete our features
* We DO NOT APPROVE self made PR
* PR's should be as short as possible
* PR's can be denied if it's too long / not up to the standarts
* We follow [PSR-Recommendations](https://www.php-fig.org/psr/)
