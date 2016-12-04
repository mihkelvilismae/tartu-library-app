<?php namespace Test\Acceptance;

use Facebook\WebDriver\WebDriverBy;

require_once('vendor/autoload.php');
require_once('AdminInterfaceTestCase.php');

class SchoolsTestCase extends AdminInterfaceTestCase
{
    const ADD_SCHOOL_LINK_TEXT = 'Lisa';
    const EDIT_SCHOOL_LINK_TEXT = 'Muuda';
    const DELETE_SCHOOL_LINK_TEXT = 'Kustuta';

    const SCHOOLS_LINK_TEXT = 'Koolid';
    const SCHOOLS_PAGE_TITLE = 'Koolid';
    const SCHOOLS_PAGE_HEADING = 'Koolid';
    const SCHOOLS_PAGE_URL = 'Koolid';

    const ADD_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME = 'name';
    const ADD_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME = 'phone';
    const ADD_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME = 'email';
    const ADD_SCHOOL_FORM_SUBMIT_BUTTON_NAME = 'submit';

    const EDIT_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME = 'name';
    const EDIT_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME = 'phone';
    const EDIT_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME = 'email';
    const EDIT_SCHOOL_FORM_SUBMIT_BUTTON_NAME = 'submit';

    // TODO: To array?
    const TEST_SCHOOL_NAME = 'test_school_name';
    const TEST_SCHOOL_EMAIL = 'test.school@ema.il';
    const TEST_SCHOOL_PHONE = '123456789';

    public function goToSchoolsOverviewPage()
    {
        $this->clickLinkWithText(self::SCHOOLS_LINK_TEXT);

        $this->assertCurrentURLIs(self::SCHOOLS_PAGE_URL);
        $this->assertPageTitleIs(self::SCHOOLS_PAGE_TITLE);
        $this->assertPageHeadingIs(self::SCHOOLS_PAGE_HEADING);
    }

    public function goToAddSchoolPageFromOverview()
    {
        $this->clickLinkWithText(self::ADD_SCHOOL_LINK_TEXT);
    }

    public function clickTestSchoolsEditButton()
    {
        $pattern = '//'; // Element from anywhere
        $pattern .= 'td[text()="' . self::TEST_SCHOOL_NAME . '"]'; // <td> of school
        $pattern .= '/..'; // Select parent element (should be <tr> holding school info <td>'s)
        $pattern .= '/td[last()]'; // Last <td> (with delete link)
        $pattern .= '/a[text()="' . self::EDIT_SCHOOL_LINK_TEXT . '"]'; // Select edit link

        $this->clickLink(WebDriverBy::xpath($pattern));
    }

    // TODO: Duplicates UseCase_AddingSchools_Test, but don't want to hide usage in there.
    public function addTestSchool()
    {
        $this->goToSchoolsOverviewPage();
        $this->goToAddSchoolPageFromOverview();
        $this->submitAddSchoolFormWithData(array(
                'name' => self::TEST_SCHOOL_NAME,
                'phone' => self::TEST_SCHOOL_PHONE,
                'email' => self::TEST_SCHOOL_EMAIL
        ));
    }

    public function submitAddSchoolFormWithData($schoolData)
    {
        $this->typeToFormInput(self::ADD_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME, $schoolData['name']);
        $this->typeToFormInput(self::ADD_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME, $schoolData['phone']);
        $this->typeToFormInput(self::ADD_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME, $schoolData['email']);

        $this->clickButton(self::ADD_SCHOOL_FORM_SUBMIT_BUTTON_NAME);
    }

    public function submitEditSchoolFormWithData($schoolData)
    {
        $this->typeToFormInput(self::EDIT_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME, $schoolData['name']);
        $this->typeToFormInput(self::EDIT_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME, $schoolData['phone']);
        $this->typeToFormInput(self::EDIT_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME, $schoolData['email']);

        $this->clickButton(self::EDIT_SCHOOL_FORM_SUBMIT_BUTTON_NAME);
    }

    public function deleteTestSchool()
    {
        $this->goToSchoolsOverviewPage();
        $this->deleteSchoolWithName(self::TEST_SCHOOL_NAME);
    }

    // TODO: DRY
    public function deleteSchoolWithName($schoolName)
    {
        $this->goToSchoolsOverviewPage();

        $pattern = '//'; // Element from anywhere
        $pattern .= 'td[text()="' . $schoolName . '"]'; // <td> with school's name as text
        $pattern .= '/..'; // Select parent element (should be <tr> holding school info <td>'s)
        $pattern .= '/td[last()]'; // Last <td> (with delete link)
        $pattern .= '/a[text()="' . self::DELETE_SCHOOL_LINK_TEXT . '"]'; // Select delete link

        $this->clickLink(WebDriverBy::xpath($pattern));
    }

    public function assertSchoolWithDataExists($schoolData)
    {
        $this->goToSchoolsOverviewPage();

        $this->assertElementsCountIs(1,
                WebDriverBy::xpath('//td[text()="' . $schoolData['name'] . '"]'));
        $this->assertElementsCountIs(1,
                WebDriverBy::xpath('//td[text()="' . $schoolData['phone'] . '"]'));
        $this->assertElementsCountIs(1,
                WebDriverBy::xpath('//td[text()="' . $schoolData['email'] . '"]'));
    }
}