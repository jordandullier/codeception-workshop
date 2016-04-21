<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 20/04/2016
 * Time: 15:54
 */

namespace Test\Project\Entity;


use Codeception\TestCase\Test;
use Project\Entity\InvoiceLine;
use Project\Exception;

class InvoiceLineTest extends Test
{
    public function testComputeTotal(){
        //PREPARE
        $invoiceLine = new InvoiceLine(2,50,20);

        //RUN
        $total = $invoiceLine->computeTotal();

        //ASSERT
        $this->assertEquals(120, $total);
    }

    public function testComputeVat(){
        //PREPARE
        $invoiceLine = new InvoiceLine(2,50,20);

        //RUN
        $vatAmount = $invoiceLine->computeVat();

        //ASSERT
        $this->assertEquals(20, $vatAmount);
    }

    /**
     * @dataProvider getDataForTestComputeTotal
     * @throws Exception
     */
    public function testComputeTotalFailsWithNegativeValues($quantity, $unitPrice, $vat, $expected){
        //PREPARE
        $invoiceLine = new InvoiceLine($quantity, $unitPrice, $vat);

        //ASSERT
        if($expected==null){
            $this->setExpectedException(Exception::class);
        }

        //RUN
        $total = $invoiceLine->computeTotal();

        if(!is_null($expected)){
            $this->assertEquals($expected, $total);
        }
    }

    public function getDataForTestComputeTotal(){
        return [
            [2, 34, 20, 81.6],
            [2, 34, 0, 68],
            [-1, 23, 0, null]
        ];
    }
}