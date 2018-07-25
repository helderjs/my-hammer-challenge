<?php

declare(strict_types=1);

namespace MyHammer\Job\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Category
 *
 * @package MyHammer\Job\Entity
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="MyHammer\Job\Repository\CategoryRepository")
 *
 * @Serializer\AccessType(type="public_method")
 */
class Category
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
     * @var int
     *
     * @ORM\Column(name="code", type="integer", length=6, nullable=false)
     *
     * @Serializer\Type("integer")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     *
     * @Serializer\Type("string")
     */
    private $name;

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
     * @return Category
     */
    public function setUuid(UuidInterface $uuid): Category
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Category
     */
    public function setCode(int $code): Category
    {
        $this->code = $code;

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
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;

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
     * @return Category
     */
    public function setCreatedAt(\DateTime $createdAt): Category
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
     * @return Category
     */
    public function setUpdatedAt(\DateTime $updatedAt): Category
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
