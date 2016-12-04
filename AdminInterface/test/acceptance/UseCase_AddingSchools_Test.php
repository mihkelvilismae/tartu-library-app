<?php namespace Test\Acceptance;

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
    function tearDown()
    {
        $this->deleteSchoolWithName(self::TEST_SCHOOL_DATA['name']);
        parent::tearDown();
    }

    public function testCanAddSchools()
    {
        $this->goToSchoolsOverviewPage();
        $this->goToAddSchoolPageFromOverview();
        $this->submitAddSchoolFormWithData(self::TEST_SCHOOL_DATA);
        $this->assertSchoolWithDataExists(self::TEST_SCHOOL_DATA);
    }
}