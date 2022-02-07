<?php

namespace Mvdgeijn\Pax8\Responses;

class Product extends AbstractResponse
{
    protected string $name;

    protected string $vendorName;

    protected string $shortDescription;

    protected string $sku;

    protected ?string $vendorSku;

    public static function parse( object $item ): Product
    {
        $product = new Product();

        $product
            ->setId($item->id)
            ->setName($item->name)
            ->setVendorName($item->vendorName)
            ->setShortDescription($item->shortDescription)
            ->setSku($item->sku)
            ->setVendorSku($item->vendorSku);

        return $product;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $vendorName
     * @return Product
     */
    public function setVendorName(string $vendorName): Product
    {
        $this->vendorName = $vendorName;
        return $this;
    }

    /**
     * @return string
     */
    public function getVendorName(): string
    {
        return $this->vendorName;
    }

    /**
     * @param string $shortDescription
     * @return Product
     */
    public function setShortDescription(string $shortDescription): Product
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $sku
     * @return Product
     */
    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $vendorSku
     * @return Product
     */
    public function setVendorSku(?string $vendorSku): Product
    {
        $this->vendorSku = $vendorSku;
        return $this;
    }

    /**
     * @return string
     */
    public function getVendorSku(): ?string
    {
        return $this->vendorSku;
    }
}
