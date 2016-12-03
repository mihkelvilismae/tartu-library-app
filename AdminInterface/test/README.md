### Acceptance testing

#### Requirements:

- Install (update) Dependencies through composer
- Java 8 JDK (for Selenium server)
- PHP (with php-curl and php-zip modules) - tested with PHP 7
- Firefox (I had problems with later Firefox versions - downgrading to v39 worked. See https://github.com/SeleniumHQ/selenium-google-code-issue-archive/issues/6955)

#### Running tests (tested on Linux; commands assume working directory is AdminInterface/test):

- Start Selenium server:

   `$ java -jar selenium-server/selenium-server-standalone-2.53.1.jar &`
- Configure test server paths in AdminInterfaceTestCase class:

    `const SELENIUM_SERVER_PATH = 'http://localhost:4444/';`
    
    `const APPLICATION_PATH = 'http://tvp.l/';`
- Run tests (must be ran from AdminInterface/test directory):

   `$ php phpunit.phar acceptance`