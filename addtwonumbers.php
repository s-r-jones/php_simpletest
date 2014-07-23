<?php
// first, require the SimpleTest framework
require_once("/usr/lib/php5/simpletest/autorun.php");

// second, require the function under scruntiny
require_once("../php_intro/addtwonumbers.php");

// third, setup the test class
class AddTwoNumbersTest extends UnitTestCase
{
    /**
     * tests adding two valid integers
     **/
    function testAddingIntegers()
    {
        // first, setup inputs & expected results
        $firstNumber    = 3;
        $secondNumber   = 4;
        $expectedAnswer = 7;

        // second, use the function to get an actual answer
        $actualAnswer = addTwoNumbers($firstNumber, $secondNumber);

        // third, assert the answer
        $this->assertEqual($actualAnswer, $expectedAnswer);
    }

    /**
     * tests adding two valid doubles
     **/
    function testAddingDoubles()
    {
        // first, setup inputs & expected results
        $firstNumber    = 3.1;
        $secondNumber   = 4.000000000000000001;
        $expectedAnswer = 7.100000000000000001;

        // second, use the function to get an actual answer
        $actualAnswer = addTwoNumbers($firstNumber, $secondNumber);

        // third, assert the answer
        $this->assertEqual($actualAnswer, $expectedAnswer);
    }

    /**
     * test invalid inputs
     **/
    function testObviouslyInvalidInputs()
    {
        // create invalid inputs
        $emptyArray  = array();
        $emptyObject = new stdClass();
        $emptyString = "";

        // test the empty array
        $this->expectException("Exception", "Invalid inputs detected");
        addTwoNumbers($emptyArray, $emptyArray);

        // test the empty object
        $this->expectException("Exception", "Invalid inputs detected");
        addTwoNumbers($emptyObject, $emptyObject);

        // test the empty string
        $this->expectException("Exception", "Invalid inputs detected");
        addTwoNumbers($emptyString, $emptyString);

        // test null
        $this->expectException("Exception", "Invalid inputs detected");
        addTwoNumbers(null, null);
    }
}
?>
