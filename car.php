<?php
require_once("/usr/lib/php5/simpletest/autorun.php");
require_once("../php_mvd/car.php");

class CarTest extends UnitTestCase
{
    /* keep track of mySQL's state:
     * the connection & what we inserted/updated/deleted/etc */
    protected $car    = null;
    protected $mysqli = null;

    // use the setUp to connect to mySQL and create a test Car
    public function setUp()
    {
        // connect to mySQL using the nobody user
        $this->mysqli = new mysqli("localhost", "sports_dylanm", "abcd-1234", "sports_dylanm");

        // create a new Car to test with
        $this->car = new Car(null, "Volkswagen", "Super Beetle");
    }

    // test inserting into mySQL
    public function testInsertCarIntoMySQL()
    {
        // first, assert the Car can be inserted
        $this->assertNull($this->car->getId());

        // now, insert to mySQL and verify the ID
        $this->car->insert($this->mysqli);
        $this->assertNotNull($this->car->getId());
        $this->assertTrue($this->car->getId() > 0);

        // finally, assert the object's other attributes
        $this->assertEqual($this->car->getMake(),  "Volkswagen");
        $this->assertEqual($this->car->getModel(), "Super Beetle");
    }

    // use tearDown to clean up after ourselves
    public function tearDown()
    {
        // first, verify the mySQL connection is sane
        if($this->mysqli !== null)
        {
            // delete the object if it seems we inserted it...
            if($this->car !== null && $this->car->getId() !== null)
            {
                $this->car->delete($this->mysqli);
            }

            // close the mySQL connection
            $this->mysqli->close();
        }
    }
}
?>
