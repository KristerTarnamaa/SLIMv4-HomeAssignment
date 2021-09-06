<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Product;

use App\Domain\Product\Product;
use App\Domain\Product\ProductNotFoundException;
use App\Domain\Product\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    /**
     * @var Product[]
     */
    private $products;

    /**
     **InMemoryProductRepository constructor.
     *
     * @param array|null $products
     */

     /*Reminder!: products consist of ID, Name, Created Date, Salequota, and price ranges (minmax) */
    public function __construct(array $products = null)
    {
        $this->products = $products ?? [
            1 => new Product(1, 'Kleenex', "1630578400", 0 , 1.12, 2.5 ),
            2 => new Product(2, 'Chocolate iScream', "1630578640", 50 , 0.85, 1.15 ),
            3 => new Product(3, 'Nicotine sticks', "1630578672", 0 , 3.90, 4.4 ),
            4 => new Product(4, 'Pikachu Clouds', "1630578707", 0 , 6.40, 7.50 ),
            5 => new Product(5, 'Hyperion Butt stallion Action Figure', "1630578740", 20 , 650, 900 ),
            6 => new Product(6, 'Hyrule Brand Sleeping Pills (100 years)', "1630578778", 1 , 5.50, 7.35 ),
            7 => new Product(7, 'Hermaeus Mora\'s Forbidden Knowledge ', "1630578810", 0 , 0.65, 0.80 ),
            8 => new Product(8, 'Handsome Jack\'s face mask', "1630582000", 1 , 1650, 1900 ),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->products);
    }

    /**
     * {@inheritdoc}
     */
    public function findProductOfId(int $id): Product
    {
        if (!isset($this->products[$id])) {
            throw new ProductNotFoundException();
        }

        return $this->products[$id];
    }
    /*
    /**
     * {@inheritdoc}
     */
/*    public  function newProduct(int $Prodid, string $ProductName, string $CreatedDate, int $SaleQuota, float $MinPrice, float $MaxPrice): Product
    {
        new Product($Prodid,$ProductName,$CreatedDate,$SaleQuota,$MinPrice,$MaxPrice);
        
    }*/
}
