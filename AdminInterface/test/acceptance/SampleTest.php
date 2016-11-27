<?php namespace Facebook\WebDriver;

require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class SampleTest extends \PHPUnit_Framework_TestCase
{
    private $driver;

    public function setUp()
    {
        // start Firefox with 5 second timeout
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::firefox();
        $this->driver = RemoteWebDriver::create($host, $capabilities, 5000);
    }

    public function tearDown()
    {
        // close the Firefox
        $this->driver->quit();
    }

    public function test()
    {
        // navigate to 'http://docs.seleniumhq.org/'
        $this->driver->get('http://docs.seleniumhq.org/');

        // adding cookie
        $this->driver->manage()->deleteAllCookies();
        $this->driver->manage()->addCookie(['name' => 'cookie_name',
            'value' => 'cookie_value',]);
        $cookies = $this->driver->manage()->getCookies();

        print_r($cookies);

        // click the link 'About'
        $link = $this->driver->findElement(
            WebDriverBy::id('menu_about')
        );
        $link->click();

        // print the title of the current page
        echo "The title is '" . $this->driver->getTitle() . "'\n";

        // print the URI of the current page
        echo "The current URI is '" . $this->driver->getCurrentURL() . "'\n";

        // Search 'php' in the search box
        $input = $this->driver->findElement(
            WebDriverBy::id('q')
        );

        $input->sendKeys('php')->submit();

        // wait at most 10 seconds until at least one result is shown
        $this->driver->wait(10)->until(
            WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
                WebDriverBy::className('gsc-result')
            )
        );
    }
}