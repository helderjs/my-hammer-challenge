<?php

declare(strict_types=1);

namespace MyHammer\Job\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use MyHammer\Job\Entity\City;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;

/**
 * Class CityFixture
 *
 * @package MyHammer\Job\DataFixtures
 */
class CityFixture extends Fixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder(): int
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager): void
    {
        $cities = [
            ['f1089efd-01a7-4410-a990-2c3002662f01', '10115', 'Berlin'],
            ['51be39e7-255a-4dfd-94da-0f58f03c343a', '32457', 'Porta Westfalica'],
            ['7e620927-3460-40a8-b092-20fded977a4e', '01623', 'Lommatzsch'],
            ['35dc6da7-4f61-401a-a06d-2de152141ecc', '21521', 'Hamburg'],
            ['ab0b3008-7c3f-47c0-9241-f1f2eb603406', '06895', 'Bülzig'],
            ['835eb748-710e-4bbf-9aa9-c9c4ae966b7c', '01612', 'Diesbar-Seußlitz'],
        ];

        $metadata = $manager->getClassMetadata(City::class);
        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());

        foreach ($cities as $city) {
            $entity = (new City())->setUuid(Uuid::fromString($city[0]))
                ->setZipCode($city[1])
                ->setName($city[2])
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            $manager->persist($entity);

            $this->addReference(sprintf('city-%s', $city[1]), $entity);
        }

        $manager->flush();

        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_CUSTOM);
        $metadata->setIdGenerator(new UuidGenerator());
    }
}
