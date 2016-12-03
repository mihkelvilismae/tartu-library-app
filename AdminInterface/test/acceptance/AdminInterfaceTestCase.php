<?php namespace Test\Acceptance;

require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class AdminInterfaceTestCase extends \PHPUnit_Framework_TestCase
{
    const SELENIUM_SERVER_PATH = 'http://localhost:4444/';
    const APPLICATION_PATH = 'http://tvp.l/';

    protected $driver;

    function setUp()
    {
        // Start Firefox with 5 second timeout
        $host = self::SELENIUM_SERVER_PATH . 'wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::firefox();
        $this->driver = RemoteWebDriver::create($host, $capabilities, 5000);

        // Load application
        $this->driver->get(self::APPLICATION_PATH);
    }

    function tearDown()
    {
        // Close Firefox
        $this->driver->quit();
    }

    public function findElementByTag($tag)
    {
        return $this->findElement(WebDriverBy::tagName($tag));
    }

    public function typeToFormInput($inputName, $text)
    {
        $this->findElementByName($inputName)->sendKeys($text);
    }

    public function clickLinkWithText($linkText)
    {
        $this->clickLink(WebDriverBy::linkText($linkText));
    }

    public function clickLink($locator)
    {
        $this->driver->findElement($locator)->click();
    }

    public function findElementByName($name)
    {
        return $this->findElement(WebDriverBy::name($name));
    }

    public function findElement($locator)
    {
        return $this->driver->findElement($locator);
    }

    public function clickButton($button_name)
    {
        $this->findElementByName($button_name)->click();
    }

    public function assertPageHeadingIs($heading)
    {
        self::assertEquals($heading, $this->findElementByTag('h1')->getText());
    }

    public function assertPageTitleIs($title)
    {
        self::assertEquals($title, $this->driver->getTitle());
    }

    public function assertElementsCountIs($count, $locator)
    {
        self::assertEquals($count, count($this->driver->findElements($locator)));
    }

    public function assertCurrentURLIs($url)
    {
        self::assertEquals(self::APPLICATION_PATH . $url, $this->driver->getCurrentURL());
    }
}