<?php

declare(strict_types=1);

namespace MyHammer\Job\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use MyHammer\Job\Entity\Category;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;

/**
 * Class CategoryFixture
 *
 * @package MyHammer\Job\DataFixtures
 */
class CategoryFixture extends Fixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder(): int
    {
        return 2;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager): void
    {
        $categories = [
            ['df3701f5-4b8d-4910-9a9f-77c06acda016', 804040, 'Sonstige Umzugsleistugen'],
            ['721fd003-e2ab-49bf-93f8-a089fa0c1fca', 802030, 'Abtransport, Entsorgung und Entrümpelung'],
            ['8813457d-3779-45b9-b46b-5ccd6cf4cb1b', 411070, 'Fensterreinigung'],
            ['dd9be6ae-ca72-446d-bf95-c3fec98fd30e', 402020, 'Holzdielen schleifen'],
            ['79f09ae0-ed36-498f-abcf-9aa9f5351ebb', 108140, 'Kellersanierung'],
        ];

        $metadata = $manager->getClassMetadata(Category::class);
        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());

        foreach ($categories as $category) {
            $entity = (new Category())->setUuid(Uuid::fromString($category[0]))
                ->setCode($category[1])
                ->setName($category[2])
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            $manager->persist($entity);

            $this->addReference(sprintf('category-%d', $category[1]), $entity);
        }

        $manager->flush();

        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_CUSTOM);
        $metadata->setIdGenerator(new UuidGenerator());
    }
}
