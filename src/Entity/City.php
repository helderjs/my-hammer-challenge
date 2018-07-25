<?php

declare(strict_types=1);

namespace MyHammer\Job\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid\UuidInterface;

/**
 * Class City
 *
 * @package MyHammer\Job\Entity
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity(repositoryClass="MyHammer\Job\Repository\CityRepository")
 *
 * @Serializer\AccessType(type="public_method")
 */
class City
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     *
     * @Serializer\Type("uuid")
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     *
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=5, nullable=false)
     *
     * @Serializer\Type("string")
     */
    private $zipCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     *
     * @Serializer\Exclude
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     *
     * @Serializer\Exclude
     */
    private $updatedAt;

    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @param UuidInterface $uuid
     * @return City
     */
    public function setUuid(UuidInterface $uuid): City
    {
        $this->uuid = $uuid;

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
     * @param string $name
     * @return City
     */
    public function setName(string $name): City
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return City
     */
    public function setZipCode(string $zipCode): City
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return City
     */
    public function setCreatedAt(\DateTime $createdAt): City
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return City
     */
    public function setUpdatedAt(\DateTime $updatedAt): City
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
