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

    const TEST_SCHOOL_DATA = [
            'name' => 'test_school_name',
            'email' => 'test.school@ema.il',
            'phone' => '123456789'
    ];

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

    // TODO: Duplicates UseCase_AddingSchools_Test, but don't want to hide usage in there.
    public function addTestSchool()
    {
        $this->goToSchoolsOverviewPage();
        $this->goToAddSchoolPageFromOverview();
        $this->submitAddSchoolFormWithData(self::TEST_SCHOOL_DATA);
    }

    public function submitAddSchoolFormWithData($schoolData)
    {
        $this->submitForm(self::ADD_SCHOOL_FORM_SUBMIT_BUTTON_NAME, [
                self::ADD_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME => $schoolData['name'],
                self::ADD_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME => $schoolData['phone'],
                self::ADD_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME => $schoolData['email']
        ]);
    }

    public function submitEditSchoolFormWithData($schoolData)
    {
        $this->submitForm(self::EDIT_SCHOOL_FORM_SUBMIT_BUTTON_NAME, [
                self::EDIT_SCHOOL_FORM_SCHOOL_NAME_INPUT_NAME => $schoolData['name'],
                self::EDIT_SCHOOL_FORM_SCHOOL_PHONE_INPUT_NAME => $schoolData['phone'],
                self::EDIT_SCHOOL_FORM_SCHOOL_EMAIL_INPUT_NAME => $schoolData['email']
        ]);
    }

    public function deleteTestSchool()
    {
        $this->goToSchoolsOverviewPage();
        $this->clickTestSchoolsRemoveButton(self::TEST_SCHOOL_DATA['name']);
    }

    // TODO: DRY
    public function clickTestSchoolsRemoveButton($schoolName)
    {
        $this->goToSchoolsOverviewPage();

        $pattern = '//'; // Element from anywhere
        $pattern .= 'td[text()="' . $schoolName . '"]'; // <td> with school's name as text
        $pattern .= '/..'; // Select parent element (should be <tr> holding school info <td>'s)
        $pattern .= '/td[last()]'; // Last <td> (with delete link)
        $pattern .= '/a[text()="' . self::DELETE_SCHOOL_LINK_TEXT . '"]'; // Select delete link

        $this->clickLink(WebDriverBy::xpath($pattern));
    }

    // TODO: DRY
    public function clickTestSchoolsEditButton()
    {
        $pattern = '//'; // Element from anywhere
        $pattern .= 'td[text()="' . self::TEST_SCHOOL_DATA['name'] . '"]'; // <td> of school
        $pattern .= '/..'; // Select parent element (should be <tr> holding school info <td>'s)
        $pattern .= '/td[last()]'; // Last <td> (with delete link)
        $pattern .= '/a[text()="' . self::EDIT_SCHOOL_LINK_TEXT . '"]'; // Select edit link

        $this->clickLink(WebDriverBy::xpath($pattern));
    }

    public function assertSchoolWithDataExists($schoolData)
    {
        $this->goToSchoolsOverviewPage();
        $this->assertSchoolWithDataCountIs($schoolData, 1);
    }

    public function assertSchoolWithDataDoesNotExist($schoolData)
    {
        $this->goToSchoolsOverviewPage();
        $this->assertSchoolWithDataCountIs($schoolData, 0);
    }

    public function assertSchoolWithDataCountIs($schoolData, $count)
    {
        $this->assertElementsCountIs($count,
                WebDriverBy::xpath('//td[text()="' . $schoolData['name'] . '"]'));
        $this->assertElementsCountIs($count,
                WebDriverBy::xpath('//td[text()="' . $schoolData['phone'] . '"]'));
        $this->assertElementsCountIs($count,
                WebDriverBy::xpath('//td[text()="' . $schoolData['email'] . '"]'));
    }
}