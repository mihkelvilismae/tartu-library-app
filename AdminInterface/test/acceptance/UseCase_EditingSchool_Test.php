<?php namespace Test\Acceptance;

require_once('SchoolsTestCase.php');

/**
 * Class UseCase_EditSchool_Test
 *
 * Use case:
 * Administrator can click on 'Edit' button. User should select school and input sheet appears
 * again. Purpose: User can edit information about schools (e.q change their e-mail) (2.3)
 *
 * @See https://github.com/mihkelvilismae/tartu-library-app/wiki/Use-cases:-Mandatory-reading-list-management
 * @package Test\Acceptance
 */
class UseCase_EditSchool_Test extends SchoolsTestCase
{
    const EDITED_SCHOOL_DATA = [
        'name' => self::TEST_SCHOOL_NAME . '_new',
        'phone' => '666666',
        'email' => self::TEST_SCHOOL_EMAIL . '.new'
    ];

    function setUp()
    {
        parent::setUp();
        $this->addTestSchool();
    }

    function tearDown()
    {
        $this->deleteSchoolWithName(self::EDITED_SCHOOL_DATA['name']);
        parent::tearDown();
    }

    public function testCanEditSchoolInfo()
    {
        $this->goToSchoolsOverviewPage();
        $this->clickTestSchoolsEditButton();
        $this->submitEditSchoolFormWithData(self::EDITED_SCHOOL_DATA);
        $this->assertSchoolWithDataExists(self::EDITED_SCHOOL_DATA);
    }
}