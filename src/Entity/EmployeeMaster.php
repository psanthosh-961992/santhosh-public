<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeMaster
 *
 * @ORM\Table(name="employee_master")
 * @ORM\Entity
 */
class EmployeeMaster
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="reporting_manager_id", type="integer", nullable=false)
     */
    private $reportingManagerId;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReportingManagerId(): ?int
    {
        return $this->reportingManagerId;
    }

    public function setReportingManagerId(int $reportingManagerId): self
    {
        $this->reportingManagerId = $reportingManagerId;

        return $this;
    }


}
