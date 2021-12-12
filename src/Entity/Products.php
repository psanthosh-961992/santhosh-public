<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Products
{
    /**
     * @var int
     *
     * @ORM\Column(name="productID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productid;

    /**
     * @var string
     *
     * @ORM\Column(name="productCode", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     */
    private $productcode = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false, options={"default"="''"})
     */
    private $name = '\'\'';

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $quantity = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=7, scale=2, nullable=false, options={"default"="99999.99"})
     */
    private $price = '99999.99';

    public function getProductid(): ?int
    {
        return $this->productid;
    }

    public function getProductcode(): ?string
    {
        return $this->productcode;
    }

    public function setProductcode(string $productcode): self
    {
        $this->productcode = $productcode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }


}
