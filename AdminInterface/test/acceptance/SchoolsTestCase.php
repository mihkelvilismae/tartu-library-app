<?php namespace Test\Acceptance;

use Facebook\WebDriver\WebDriverBy;

require_once('vendor/autoload.php');
require_once('AdminInterfaceTestCase.php');

class SchoolsTestCase extends AdminInterfaceTestCase
{
    const SCHOOLS_LINK_TEXT = 'Koolid';
    const SCHOOLS_PAGE_TITLE = 'Koolid';
    const SCHOOLS_PAGE_HEADING = 'Koolid';
    const SCHOOLS_PAGE_URL = 'Koolid';
    const DELETE_SCHOOL_LINK_TEXT = 'Kustuta';

    const ADD_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME = 'name';
    const ADD_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME = 'phone';
    const ADD_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME = 'email';
    const ADD_SCHOOL_FORM_SUBMIT_BUTTON_NAME = 'submit';

    const TEST_SCHOOL_NAME = 'test_school_name';
    const TEST_SCHOOL_EMAIL = 'test.school@ema.il';
    const TEST_SCHOOL_PHONE = '123456789';

    function setUp()
    {
        parent::setUp();

        $this->goToSchoolsListPage();
    }

    public function goToSchoolsListPage()
    {
        $this->clickLinkWithText(self::SCHOOLS_LINK_TEXT);

        $this->assertCurrentURLIs(self::SCHOOLS_PAGE_URL);
        $this->assertPageTitleIs(self::SCHOOLS_PAGE_TITLE);
        $this->assertPageHeadingIs(self::SCHOOLS_PAGE_HEADING);
    }

    public function deleteTestSchool()
    {
        $this->goToSchoolsListPage();
        $this->deleteSchoolWithName(self::TEST_SCHOOL_NAME);
    }

    public function deleteSchoolWithName($schoolName)
    {
        $this->goToSchoolsListPage();

        $pattern = '//'; // Element from anywhere
        $pattern .= 'td[text()="' . $schoolName . '"]'; // <td> with school's name as text
        $pattern .= '/..'; // Select parent element (should be <tr> holding school info <td>'s)
        $pattern .= '/td[last()]'; // Last <td> (with delete link)
        $pattern .= '/a[text()="' . self::DELETE_SCHOOL_LINK_TEXT . '"]'; // Select delete link

        $this->clickLink(WebDriverBy::xpath($pattern));
    }
}