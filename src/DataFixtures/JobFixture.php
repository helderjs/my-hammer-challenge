<?php

declare(strict_types=1);

namespace MyHammer\Job\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use MyHammer\Job\Entity\Job;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;

/**
 * Class JobFixture
 *
 * @package MyHammer\Job\DataFixtures
 */
class JobFixture extends Fixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder(): int
    {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager): void
    {
        $metadata = $manager->getClassMetadata(Job::class);
        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());

        $manager->persist(
            (new Job())->setUuid(Uuid::fromString("b9596b68-fb7f-44a6-aba6-356f6fc5d11b"))
                ->setTitle('My job title')
                ->setDescription('My job description')
                ->setExecutionDate(new \DateTime('2018-07-24'))
                ->setCity($this->getReference('city-10115'))
                ->setCategory($this->getReference('category-804040'))
                ->setCreatedAt(new \DateTime('2018-07-24'))
                ->setUpdatedAt(new \DateTime())
        );

        $manager->flush();

        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_CUSTOM);
        $metadata->setIdGenerator(new UuidGenerator());
    }
}
