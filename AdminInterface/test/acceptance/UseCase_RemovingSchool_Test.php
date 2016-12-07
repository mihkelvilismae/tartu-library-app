<?php namespace Test\Acceptance;

require_once('SchoolsTestCase.php');

/**
 * Class UseCase_RemoveSchool_Test
 *
 * Use case:
 * Administrator can click on 'Remove' button. User should select school and press button 'OK'
 * Purpose: user can remove schools from the system. (2.4)
 *
 * @See https://github.com/mihkelvilismae/tartu-library-app/wiki/Use-cases:-Mandatory-reading-list-management
 * @package Test\Acceptance
 */
class UseCase_RemoveSchool_Test extends SchoolsTestCase
{
    function setUp()
    {
        parent::setUp();
        $this->addTestSchool();
    }

    public function testCanDeleteSchool()
    {
        $this->goToSchoolsOverviewPage();
        $this->clickTestSchoolsRemoveButton(self::TEST_SCHOOL_DATA['name']);
        $this->assertSchoolWithDataDoesNotExist(self::TEST_SCHOOL_DATA);
    }
}