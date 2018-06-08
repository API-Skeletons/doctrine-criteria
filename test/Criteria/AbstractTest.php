<?php

namespace ZFTest\Doctrine\Criteria;

use Datetime;
use Doctrine\Common\Collections\ArrayCollection;
use DbTest\Entity\Test;

abstract class AbstractTest extends \Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase
{
    protected function provideCollection()
    {
        return new ArrayCollection([
            (new Test())
                ->setTestString('abcde')
                ->setTestInteger(1000)
                ->setTestBigint(12345)
                ->setTestDateTime(new DateTime())
                ->setTestDate(new DateTime())
                ->setTestDecimal(12.345)
                ->setTestFloat(54.321)
                ->setTestBoolean(true)
                ->setTestArray([5, 6, 7]),
            (new Test())
                ->setTestString('fghij')
                ->setTestInteger(2000)
                ->setTestBigint(12345)
                ->setTestDateTime(new DateTime())
                ->setTestDate(new DateTime())
                ->setTestDecimal(12.345)
                ->setTestFloat(54.321)
                ->setTestBoolean(true)
                ->setTestArray([8, 9, 10]),
            (new Test())
                ->setTestString('klmno')
                ->setTestInteger(3000)
                ->setTestBigint(12345)
                ->setTestDateTime(new DateTime())
                ->setTestDate(new DateTime())
                ->setTestDecimal(12.345)
                ->setTestFloat(54.321)
                ->setTestBoolean(true)
                ->setTestArray([11, 12, 13]),
            (new Test())
                ->setTestString('pqrst')
                ->setTestInteger(4000)
                ->setTestBigint(12345)
                ->setTestDateTime(new DateTime())
                ->setTestDate(new DateTime())
                ->setTestDecimal(12.345)
                ->setTestFloat(54.321)
                ->setTestBoolean(true)
                ->setTestArray([5, 15, 16]),
            (new Test())
                ->setTestString('uvwxy')
                ->setTestInteger(5000)
                ->setTestBigint(12345)
                ->setTestDateTime(new DateTime())
                ->setTestDate(new DateTime())
                ->setTestDecimal(12.345)
                ->setTestFloat(54.321)
                ->setTestBoolean(true)
                ->setTestArray([5, 18, 19]),
        ]);
    }

    protected function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../config/test.config.php'
        );

        parent::setUp();
    }
}
