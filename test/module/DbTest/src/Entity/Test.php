<?php

namespace DbTest\Entity;

class Test
{
    public $id;
    public $testString;
    public $testInteger;
    public $testBigint;
    public $testDateTime;
    public $testDate;
    public $testDecimal;
    public $testFloat;
    public $testBoolean;
    public $testArray;

    public function __construct()
    {
        $this->testArray = [];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTestString($value)
    {
        $this->testString = $value;

        return $this;
    }
    public function setTestInteger($value)
    {
        $this->testInteger = $value;

        return $this;
    }
    public function setTestBigint($value)
    {
        $this->testBigint = $value;

        return $this;
    }
    public function setTestDateTime($value)
    {
        $this->testDateTime = $value;

        return $this;
    }
    public function setTestDate($value)
    {
        $this->testDate = $value;

        return $this;
    }
    public function setTestDecimal($value)
    {
        $this->testDecimal = $value;

        return $this;
    }
    public function setTestFloat($value)
    {
        $this->testFloat = $value;

        return $this;
    }
    public function setTestBoolean($value)
    {
        $this->testBoolean = $value;

        return $this;
    }
    public function setTestArray($value)
    {
        $this->testArray = $value;

        return $this;
    }
}
