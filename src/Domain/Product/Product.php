<?php
declare(strict_types=1);

namespace App\Domain\Product;

use JsonSerializable;

class Product implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $productid;

    /**
     * @var string
     */
    private $productname;

    /**
     * @var string
     */
    private $createddate;

    /**
     * @var int
     */
    private $SaleQuota;

    /**
     * @var float
     */
    private $MinimumPriceRange;

    /**
     * @var float
     */
    private $MaximumPriceRange;

    /**
     * @param int|null  $id
     * @param string    $productname
     * @param string    $createddate
     * @param int|null    $SaleQuota
     * @param float|null    $MinimumPriceRange
     * @param float|null    $MaximumPriceRange
     */
    public function __construct(?int $id, string $productname, string $createddate, ?int $SaleQuota, float $MinimumPriceRange, float $MaximumPriceRange)
    {
        $this->id = $id;
        $this->productname = ucfirst($productname);
        $this->createddate = $createddate;
        $this->SaleQuota = $SaleQuota;
        $this->MinimumPriceRange = $MinimumPriceRange;
        $this->MaximumPriceRange = $MaximumPriceRange;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getproductname(): string
    {
        return $this->productname;
    }

    /**
     * @return string
     */
    public function getcreateddate(): string
    {
        return $this->createddate;
    }

    /**
     * @return int
     */
    public function getSaleQuota(): ?int
    {
        return $this->SaleQuota;
    }

    /**
     * @return float
     */
    public function getMinimumPriceRange(): float
    {
        return $this->MinimumPriceRange;
    }

    /**
     * @return float
     */
    public function getMaximumPriceRange(): float
    {
        return $this->MaximumPriceRange;
    }

    /**
     * {@inheritdoc}
     */
    public static function newProduct(int $Prodid, string $ProductName, string $CreatedDate, int $SaleQuota, float $MinPrice, float $MaxPrice)
    {
        new Product($Prodid,$ProductName,$CreatedDate,$SaleQuota,$MinPrice,$MaxPrice);
        
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'productname' => $this->productname,
            'createddate' => $this->createddate,
            'Number of Product to be sold' => $this->SaleQuota,
            'Minimum Price Range' => $this->MinimumPriceRange,
            'Maximum Price Range' => $this->MaximumPriceRange,
        ];
    }
}
