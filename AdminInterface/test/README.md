### Acceptance testing

#### Requirements:

- Install (update) Dependencies through composer
- Java 8 JDK (for Selenium server)
- PHP (with php-curl and php-zip modules)
- Firefox

#### Running tests (tested on Linux; commands assume working directory is AdminInterface/test):

- Start Selenium server:

   `$ java -jar selenium-server/selenium-server-standalone-2.53.1.jar &`
- Run tests (must be ran from AdminInterface/test directory):

   `$ php phpunit.phar acceptance`