<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SchemaMigrations
 *
 * @ORM\Table(name="schema_migrations")
 * @ORM\Entity
 */
class SchemaMigrations
{
    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $version;

    public function getVersion(): ?string
    {
        return $this->version;
    }


}
