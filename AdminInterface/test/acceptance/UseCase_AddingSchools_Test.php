<?php namespace Test\Acceptance;

use Facebook\WebDriver\WebDriverBy;

require_once('SchoolsTestCase.php');

/**
 * Class UseCase_AddingSchools_Test
 *
 * Use case:
 * Administrator can click on 'Add' button. Input sheet appears - user adds school's name, classes,
 * contact information.
 * Outcome: User can add new schools to the system. (2.2)
 *
 * @See https://github.com/mihkelvilismae/tartu-library-app/wiki/Use-cases:-Mandatory-reading-list-management
 * @package Test\Acceptance
 */
class UseCase_AddingSchools_Test extends SchoolsTestCase
{
    const ADD_SCHOOL_LINK_TEXT = 'Lisa';

    function tearDown()
    {
        $this->deleteTestSchool(); // Delete school before we close webdriver
        parent::tearDown();
    }

    public function testCanAddSchools()
    {
        $this->clickLinkWithText(self::ADD_SCHOOL_LINK_TEXT);
        $this->submitTestDataToAddSchoolForm();

        $this->assertSchoolWithTestDataExists();
    }

    public function submitTestDataToAddSchoolForm()
    {
        $this->typeToFormInput(self::ADD_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME,
                self::TEST_SCHOOL_NAME);
        $this->typeToFormInput(self::ADD_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME,
                self::TEST_SCHOOL_PHONE);
        $this->typeToFormInput(self::ADD_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME,
                self::TEST_SCHOOL_EMAIL);

        $this->clickButton(self::ADD_SCHOOL_FORM_SUBMIT_BUTTON_NAME);
    }

    public function assertSchoolWithTestDataExists()
    {
        $this->goToSchoolsListPage();

        $this->assertElementsCountIs(1,
                WebDriverBy::xpath('//td[text()="' . self::TEST_SCHOOL_NAME . '"]'));
        $this->assertElementsCountIs(1,
                WebDriverBy::xpath('//td[text()="' . self::TEST_SCHOOL_PHONE . '"]'));
        $this->assertElementsCountIs(1,
                WebDriverBy::xpath('//td[text()="' . self::TEST_SCHOOL_EMAIL . '"]'));
    }
}