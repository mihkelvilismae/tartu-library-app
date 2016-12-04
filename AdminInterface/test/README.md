### Acceptance testing

#### Requirements:

- Install (update) Dependencies through composer
- Java 8 JDK (for Selenium server)
- PHP (with php-curl and php-zip modules) - tested with PHP 7
- Firefox (I had problems with later Firefox versions - downgrading to v39 worked.
See https://github.com/SeleniumHQ/selenium-google-code-issue-archive/issues/6955)

#### Running tests (tested on Linux; commands assume working directory is AdminInterface/test):

- Start Selenium server:

   `$ java -jar selenium-server/selenium-server-standalone-2.53.1.jar &`
- Configure test server paths in AdminInterfaceTestCase class:

    `const SELENIUM_SERVER_PATH = 'http://localhost:4444/';`
    
    `const APPLICATION_PATH = 'http://tvp.l/';`
- Run tests (must be ran from AdminInterface/test directory):

   `$ php phpunit.phar acceptance`
   
### Load testing

#### Requirements

- Java 8 JDK (for JMeter)

#### Add and remove school test

- This test simulates 100 users concurrently creating a school and deleting it ten times.
- Each created school has unique name based on the user's id.

#### Sample results

- There is a sample test result provided, ran in a virtual machine running Ubuntu Server 16.04.1
LTS, Apache 2.4.18, PHP 7.0.8 and MySQL 5.7.16.
- Server specifications (tests took 11 seconds):
    - 3 physical CPU cores (up to 3.1 GHz)
    - 8 GB physical memory
    - SSD

#### Running load tests (tested on Linux; commands assume working directory is AdminInterface/test/load):

- Modify Add_and_remove_school.jmx test plan with the application path (default is localhost). 
Either open test plan with JMeter GUI (and change app_path user variable in App settings block) or 
modify the file directly, replacing the value in this line (near the end of the file). 
NB! Do not add any slashes or http:// prefix.

    `<stringProp name="Argument.value">localhost</stringProp>`
- To run tests and generate report (warning: can take up to 45 seconds):

    `./apache-jmeter-3.1/bin/jmeter -n -t Add_and_remove_school.jmx -l tmp -e -o results/`
    
- After the command has finished, a report is created into results/ directory, open index.html in 
browser to see the details.