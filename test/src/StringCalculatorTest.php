<?php

require_once dirname(__FILE__) . '/../../src/StringCalculator.php';

/**
 * Test class for StringCalculator.
 * Generated by PHPUnit on 2013-01-13 at 19:20:49.
 */
class StringCalculatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var StringCalculator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new StringCalculator;
    }
    
    public function testEmptyStringWillReturn0(){
        $this->assertEquals(0, $this->object->add(""));
    }
    
    public function test1WillReturn1(){
        $this->assertEquals(1, $this->object->add("1"));
    }
    
    public function testTwoNumbersWithCommaSeparator(){
        $this->assertEquals(2, $this->object->add("1,1"));
    }
    
    public function testTwoNumbersSeparatedByNewLines(){
        $this->assertEquals(2, $this->object->add("1\n1"));
    }
    
    public function testTwoNumbersSeparatedByNewLinesOrCommas(){
        $this->assertEquals(5, $this->object->add("1\n1,3"));
    }
    
    public function testTwoNumbersCustomDelimiter(){
        $this->assertEquals(2, $this->object->add("//3\n131"));
    }
    
    /**
     * @expectedException StringCalculatorNegativeNumberException
     */
    public function testNegativeThrowsException(){
        $this->object->add('-2');
    }
    
    public function testMultipleNegativeThrowsException(){
        try{
            $this->object->add('-2,-3,-4');
            $this->fail('Expected StringCalculatorNegativeNumberException');
        } catch (StringCalculatorNegativeNumberException $e){
            $this->assertEquals('negatives not allowed -2,-3,-4', $e->getMessage());
        }
    }
    
    public function testNumbersBiggerThan1000ShouldBeIgnored(){
        $this->assertEquals(1,$this->object->add('1002,1'));
    }
    
    public function testAllowMultipleCustomDelimiters(){
        $this->assertEquals(6, $this->object->add("//[*][%]\n1*2%3"));
    }
    
    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

}

?>
