<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

require_once __DIR__ . "/ObjectComparator.php";

class ObjectComparatorTest extends \PHPUnit\Framework\TestCase
{

    public function testBooleans() {
        $this->assertTrue(ObjectComparator::isBool(true));
        $this->assertTrue(ObjectComparator::isBool(false));
        $this->assertTrue(ObjectComparator::isBool(1));
        $this->assertTrue(ObjectComparator::isBool(0));
        $this->assertTrue(ObjectComparator::isBool("1"));
        $this->assertTrue(ObjectComparator::isBool("0"));
        $this->assertTrue(ObjectComparator::isBool("true"));
        $this->assertTrue(ObjectComparator::isBool("false"));
        $this->assertTrue(ObjectComparator::isBool("TRUE"));
        $this->assertTrue(ObjectComparator::isBool("FALSE"));
        $this->assertTrue(ObjectComparator::isBool("True"));
        $this->assertTrue(ObjectComparator::isBool("False"));

        $this->assertFalse(ObjectComparator::isBool("Fals"));
        $this->assertFalse(ObjectComparator::isBool("Tru"));
        $this->assertFalse(ObjectComparator::isBool("other value"));
        $this->assertFalse(ObjectComparator::isBool(0.1));
        $this->assertFalse(ObjectComparator::isBool(-1));
        $this->assertFalse(ObjectComparator::isBool(2));

    }

    public function testEmptyObjectsAreEqual()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $this->assertTrue(ObjectComparator::compare($first, $second));
    }

    public function testEmptyObjectIsNotEqualToNotEmpty()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $second->differentField = "Different field";
        $this->assertFalse(ObjectComparator::compare($first, $second));
        $this->assertFalse(ObjectComparator::compare($second, $first));
    }

    public function testSameFieldValueEquals()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->differentField = "Same field, same value";
        $second->differentField = "Same field, same value";
        $this->assertTrue(ObjectComparator::compare($first, $second));
        $this->assertTrue(ObjectComparator::compare($second, $first));
    }

    public function testDifferentFieldValueNotEquals()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->differentField = "Same field, different value";
        $second->differentField = "Same field, another different value";
        $this->assertFalse(ObjectComparator::compare($first, $second));
    }

    public function testDifferentFieldSameValue()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->differentField = "Same value";
        $second->anotherField = "Same value";
        $this->assertFalse(ObjectComparator::compare($first, $second));
    }

    public function testMultipleFields()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->firstField = "Same value";
        $second->firstField = "Same value";
        $first->secondField = "Same second value";
        $second->secondField = "Same second value";
        $this->assertTrue(ObjectComparator::compare($first, $second));
        $second->secondField = "Different second value";
        $this->assertFalse(ObjectComparator::compare($first, $second));
    }

    public function testSameArrays()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->arrayField = ["1", "2", "3"];
        $second->arrayField = ["1", "2", "3"];
        $this->assertTrue(ObjectComparator::compare($first, $second));
    }

    public function testDifferentArrays()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->arrayField = ["1", "2", "3"];
        $second->arrayField = ["1", "2", "3", "4"];
        $this->assertFalse(ObjectComparator::compare($first, $second));
    }

    public function testWrongArrayOrder()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->arrayField = ["1", "2", "3"];
        $second->arrayField = ["1", "3", "2"];
        $this->assertFalse(ObjectComparator::compare($first, $second));
    }

    public function testMultilevelStructure()
    {
        $first = new \stdClass();
        $second = new \stdClass();
        $first->firstField = "Same value";
        $second->firstField = "Same value";
        $first->secondField = "Same second value";
        $second->secondField = "Same second value";
        $first->objectField = new \stdClass();
        $first->objectField->firstSubfield = "Still same value";
        $second->objectField = new \stdClass();
        $second->objectField->firstSubfield = "Still same value";
        $this->assertTrue(ObjectComparator::compare($first, $second));
        $second->objectField->firstSubfield = "Different second value";
        $this->assertFalse(ObjectComparator::compare($first, $second));
    }
}