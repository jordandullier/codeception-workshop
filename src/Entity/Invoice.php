<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 20/04/2016
 * Time: 10:57
 */

namespace Project\Entity;


class Invoice
{
    protected $invoiceLines = [];

    public function computeTotal(){

        $total = 0;

        $invoiceLines = $this->getInvoiceLines();

        foreach($invoiceLines as $invoiceLine){
            $total += $invoiceLine->computeTotal();
        }

        return $total;
    }

    public function computeVat(){
        $total = 0;
        $invoiceLines = $this->getInvoiceLines();

        foreach($invoiceLines as $invoiceLine){
            $total += $invoiceLine->computeVat();
        }
        return $total;
    }

    /**
     * @return array
     */
    public function getInvoiceLines()
    {
        return $this->invoiceLines;
    }

    /**
     * @param array $invoiceLines
     */
    public function setInvoiceLines($invoiceLines)
    {
        $this->invoiceLines = $invoiceLines;
    }


}