<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 20/04/2016
 * Time: 10:57
 */

namespace Project\Entity;
use Project\Exception;

class InvoiceLine
{
    protected $quantity;
    protected $unitPrice;
    protected $vat;


    /**
     * InvoiceLine constructor.
     * @param $quantity
     * @param $unitPrice
     * @param $vat
     */
    public function __construct($quantity, $unitPrice, $vat)
    {
        $this->setQuantity($quantity);
        $this->setUnitPrice($unitPrice);
        $this->setVat($vat);
    }


    public function computeTotal(){

        $quantity = $this->getQuantity();
        if($quantity<0){
            throw new Exception("Cannot compute negative values");
        }

        $unitPrice = $this->getUnitPrice();
        if($unitPrice<0){
            throw new Exception("Cannot compute negative values");
        }

        $vat = $this->getVat();
        if($vat<0){
            throw new Exception("Cannot compute negative values");
        }

        $totalWithoutVat = $quantity*$unitPrice;
        $totalVat = (($quantity*$unitPrice)*$vat)/100;

        return $totalWithoutVat+$totalVat;
    }

    public function computeVat(){

        $quantity = $this->getQuantity();
        $unitPrice = $this->getUnitPrice();
        $vat = $this->getVat();

        return ((($unitPrice*$quantity)*$vat)/100);
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param mixed $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

}