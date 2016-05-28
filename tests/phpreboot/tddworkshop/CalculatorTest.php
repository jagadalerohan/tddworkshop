<?php

namespace phpreboot\tddworkshop;

use phpreboot\tddworkshop\Calculator;

class CaltulatorTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Calucator
	 */
	private $calculator;

	// Function to setup  calculator
	public function setUp()
	{
		$this->calculator = new Calculator();
	}

	// Function to clear calculator
	public function tearDown()
	{
		$this->calculator = null;
	}

	// Test for add returns an integer
	public function testAddReturnsAnInteger()
	{
        $result = $this->calculator->calculation();
        $this->assertInternalType('integer', $result, 'Result of `add` is not an integer.');
	}

	// Test for add for zero parameters
	public function testAddWithoutparameterReturnsZero()
	{
        $result = $this->calculator->calculation();
        $this->assertSame(0, $result, 'Empty string on add do not return 0');
	}

	// Test for add single number return same number
	public function testAddWithSingleNumberReturnsSameNumber()
	{
        $result = $this->calculator->calculation('3');
        $this->assertSame(3, $result, 'Add with single number do not returns same number');

	}

	// Test for add two parameter return sum 
	public function testAddWithTwoParametersReturnsTheirSum()
    {
        $result = $this->calculator->calculation('2,4');
        $this->assertSame(6, $result, 'Add with two parameter do not returns correct sum');
    }

    /**
      *  Test to thow exception for non string parameter 
      * @expectedException \InvalidArgumentException
      */
     public function  testAddWithNonStringParameterThrowsException()
     {
         $this->calculator->calculation(5, 'Integer parameter do not throw error');
     }

    /**
     * Test to throw  the exception for invalid argument 
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNonNumbersThrowException()
    {
        $this->calculator->calculation('1,a', 'Invalid parameter do not throw exception');
    }

    /**
     * Test for multiple number
     * @dataProvider testMultipleNumberStringDataProvider
     */
    public function testMultipleNumberString($numbers, $expectedResult)
    {
    	$result = $this->calculator->calculation($numbers);
    	$this->assertSame($result, $expectedResult, 'The result does not match expected result');
    }

    /**
     * Data provider to test multiple numbers
     */
    public function testMultipleNumberStringDataProvider()
    {
    	return array( 
    		array('', 0),
    		array('1', 1),
    		array('2,3', 5),
    		array('4,5,6', 15),
    		array('2,3,4,5', 14),
    		array('4,7,3,4,7,3,5,6,7,4,3,2,5,7,5,3,4,6,7,8,9,5,5,5,4,3,2', 133));
    }

    /**
     * Test add function to replace special charactor
     */
    public function testAddForSpecialCharactors()
    {
		$result = $this->calculator->calculation('2\n3,4');
		$this->assertSame($result, 9, 'The result does not match expected result');
    }

    /**
     * Test add function to replace special charactor
     */
    public function testAddForSpecialCharactorsTest4()
    {
		$result = $this->calculator->calculation('\\;\\3;4;5');
		$this->assertSame($result, 12, 'The result does not match expected result');
    }

    /**
     *	Function to test negative numners
     * @expectedException \InvalidArgumentException
     */
    public function testNegativeNumber() 
    {
    	$this->calculator->calculation('\\,\\2,7,-3,5,-2', 'Negative numbers not allowed.');	
    }

    /**
     *  Test for numbers greater than 1000
     */
    public function testNumberGreaterThanThousand() 
    {
    	$result = $this->calculator->calculation('10,20,1010,20');
		$this->assertSame($result, 50, 'The result does not match expected result');
    }


    /**
     *  Test for numbers greater than 1000 for multiplication
     */
    public function testNumberGreaterThanThousandMultiplication() 
    {
    	$result = $this->calculator->calculation('10,20,1010,20', 'mul');
		$this->assertSame($result, 4000, 'The result does not match expected result');
    }
} 