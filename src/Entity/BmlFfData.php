<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BmlFfData
 *
 * @ORM\Table(name="bml_ff_data")
 * @ORM\Entity
 */
class BmlFfData
{
    /**
     * @var int
     *
     * @ORM\Column(name="bml_ffd_pkid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bmlFfdPkid;

    /**
     * @var int
     *
     * @ORM\Column(name="bml_fkid", type="integer", nullable=false)
     */
    private $bmlFkid;

    /**
     * @var string
     *
     * @ORM\Column(name="param_name", type="string", length=150, nullable=false)
     */
    private $paramName;

    /**
     * @var string
     *
     * @ORM\Column(name="param_value", type="string", length=150, nullable=false)
     */
    private $paramValue;

    public function getBmlFfdPkid(): ?int
    {
        return $this->bmlFfdPkid;
    }

    public function getBmlFkid(): ?int
    {
        return $this->bmlFkid;
    }

    public function setBmlFkid(int $bmlFkid): self
    {
        $this->bmlFkid = $bmlFkid;

        return $this;
    }

    public function getParamName(): ?string
    {
        return $this->paramName;
    }

    public function setParamName(string $paramName): self
    {
        $this->paramName = $paramName;

        return $this;
    }

    public function getParamValue(): ?string
    {
        return $this->paramValue;
    }

    public function setParamValue(string $paramValue): self
    {
        $this->paramValue = $paramValue;

        return $this;
    }


}
