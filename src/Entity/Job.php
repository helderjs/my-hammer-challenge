<?php

declare(strict_types=1);

namespace MyHammer\Job\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Job
 *
 * @package MyHammer\Job\Entity
 *
 * @ORM\Table(name="jobs")
 * @ORM\Entity(repositoryClass="MyHammer\Job\Repository\JobRepository")
 *
 * @Serializer\AccessType(type="public_method")
 */
class Job
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
     * @ORM\Column(name="title", type="string", nullable=false)
     *
     * @Serializer\Type("string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     *
     * @Serializer\Type("string")
     */
    private $description;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="MyHammer\Job\Entity\City")
     * @ORM\JoinColumn(name="city_uuid", referencedColumnName="uuid")
     * @Serializer\Type("MyHammer\Job\Entity\City")
     */
    private $city;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="MyHammer\Job\Entity\Category")
     * @ORM\JoinColumn(name="category_uuid", referencedColumnName="uuid")
     *
     * @Serializer\Type("MyHammer\Job\Entity\Category")
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="execution_date", type="datetime", nullable=false)
     *
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    private $executionDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     *
     * @Serializer\Type("DateTime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     *
     * @Serializer\Type("DateTime")
     */
    private $updatedAt;

    /**
     * @return UuidInterface
     */
    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @param UuidInterface $uuid
     * @return Job
     */
    public function setUuid(UuidInterface $uuid): Job
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Job
     */
    public function setTitle(string $title): Job
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Job
     */
    public function setDescription(string $description): Job
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return City
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return Job
     */
    public function setCity(City $city): Job
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Job
     */
    public function setCategory(Category $category): Job
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExecutionDate(): ?\DateTime
    {
        return $this->executionDate;
    }

    /**
     * @param \DateTime $executionDate
     * @return Job
     */
    public function setExecutionDate(\DateTime $executionDate): Job
    {
        $this->executionDate = $executionDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Job
     */
    public function setCreatedAt(\DateTime $createdAt): Job
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Job
     */
    public function setUpdatedAt(\DateTime $updatedAt): Job
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
