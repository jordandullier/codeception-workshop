<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 21/04/2016
 * Time: 09:47
 */

namespace Test\Project\Entity;


use Codeception\TestCase\Test;
use Codeception\Util\Stub;
use Project\Entity\Invoice;
use Project\Entity\InvoiceLine;

class InvoiceTest extends Test
{
    public function testInvoiceLinesAccessors(){

        $invoice = new Invoice();
        $invoiceLines = [];

        $invoiceLines[] = $this->getMockBuilder(InvoiceLine::class)->disableOriginalConstructor()->getMock();
        $invoiceLines[] = $this->getMockBuilder(InvoiceLine::class)->disableOriginalConstructor()->getMock();

        $invoice->setInvoiceLines($invoiceLines);

        //On s'assure que $invoicesLines est bien affecté à l'attribut 'invoiceLines' de l'objet $invoice
        $this->assertAttributeEquals($invoiceLines,'invoiceLines',$invoice);
        $this->assertEquals($invoiceLines,$invoice->getInvoiceLines());
    }

    public function testComputeTotal(){
        //PREPARE
        $invoice = new Invoice();
        $invoiceLines = [];

        /*
        $invoiceLines[] = $this->generateInvoiceLineMock(44);
        $invoiceLines[] = $this->generateInvoiceLineMock(11);
        */

        $invoiceLines[] = Stub::make(InvoiceLine::class, ['computeTotal' => 44]);
        $invoiceLines[] = Stub::make(InvoiceLine::class, ['computeTotal' => 11]);

        $invoice->setInvoiceLines($invoiceLines);

        //RUN
        $total = $invoice->computeTotal();

        //ASSERT

        $this->assertEquals($total,55);


    }

    public function testComputeVat(){
        //PREPARE
        $invoice = new Invoice();
        $invoiceLines = [];

        //Permet ici de tester computeVat de Invoice sans dépendre du code de computeVat de InvoiceLine
        //Sans cela le test de computeVat de Invoice serait amener à planter alors qu'elle fonctionne bien
        $invoiceLines[] = Stub::make(InvoiceLine::class, ['computeVat' => 7]);
        $invoiceLines[] = Stub::make(InvoiceLine::class, ['computeVat' => 3]);

        $invoice->setInvoiceLines($invoiceLines);

        //RUN
        $vatAmount = $invoice->computeVat();

        //ASSERT
        $this->assertEquals(10,$vatAmount);
    }

    public function computeVatBreakdown

    protected function generateInvoiceLineMock($total){
        $invoiceLine = $this->getMockBuilder(InvoiceLine::class)
            ->disableOriginalConstructor()
            ->getMock();
        $invoiceLine->method('computeTotal')->willReturn($total);
        return $invoiceLine;
    }



}