<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BmlMaster
 *
 * @ORM\Table(name="bml_master")
 * @ORM\Entity
 */
class BmlMaster
{
    /**
     * @var int
     *
     * @ORM\Column(name="bml_pkid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bmlPkid;

    /**
     * @var string
     *
     * @ORM\Column(name="part_code", type="string", length=150, nullable=false)
     */
    private $partCode;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=150, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="preferred_material", type="string", length=150, nullable=false)
     */
    private $preferredMaterial;

    public function getBmlPkid(): ?int
    {
        return $this->bmlPkid;
    }

    public function getPartCode(): ?string
    {
        return $this->partCode;
    }

    public function setPartCode(string $partCode): self
    {
        $this->partCode = $partCode;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPreferredMaterial(): ?string
    {
        return $this->preferredMaterial;
    }

    public function setPreferredMaterial(string $preferredMaterial): self
    {
        $this->preferredMaterial = $preferredMaterial;

        return $this;
    }


}
