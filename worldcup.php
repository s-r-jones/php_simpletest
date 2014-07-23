<?php
// first, require SimpleTest
require_once("/usr/lib/php5/simpletest/autorun.php");

// second, require the class under scrutiny
require_once("../php_oop/worldcup.php");

class WorldCupTest extends UnitTestCase
{
    /* we make variables used in setUp() and tearDown()
     * member (state) variables of the test */
    protected $worldCup = null;

    /**
     * setup the tests for valid inputs
     **/
    public function setUp()
    {
        /* this is really a placeholder for when we need to
         * make connections, download API data, etc */
        $this->worldCup = new WorldCup(50000, "Recife", 2.5e9, 68, 712);
    }

    /**
     * test the valid case using the object from setUp()
     **/
    public function testValidInputs()
    {
        // establish our expected outputs
        $expectedAttendance  = 50000;
        $expectedLocation    = "Recife";
        $expectedTvRatings   = 2.5e9;
        $expectedRedCards    = 68;
        $expectedYellowCards = 712;

        /* no need for actual outputs since we took
         * care of that in the setUp() method */

        /* when making connections, always assert the
         * setUp() method worked and made the connection
         * DO NOT SIMPLY TAKE IT ON FAITH!! */
        $this->assertNotNull($this->worldCup);

        // assert each member variable
        $this->assertEqual($this->worldCup->getAttendance(),  $expectedAttendance);
        $this->assertEqual($this->worldCup->getLocation(),    $expectedLocation);
        $this->assertEqual($this->worldCup->getTvRatings(),   $expectedTvRatings);
        $this->assertEqual($this->worldCup->getRedCards(),    $expectedRedCards);
        $this->assertEqual($this->worldCup->getYellowCards(), $expectedYellowCards);
    }

    public function testObviouslyBadInputs()
    {
        // setup some trash inputs: null, empty array, empty object
        $badInputs = array(null, array(), new stdClass());

        foreach($badInputs as $badInput)
        {
            $this->expectException("RuntimeException");
            $teamEngland = new WorldCup($badInput, $badInput, $badInput, $badInput, $badInput, $badInput);
        }
    }
}
?>
