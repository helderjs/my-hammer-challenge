<?php

declare(strict_types=1);

namespace MyHammer\Job\Form\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use MyHammer\Job\Entity\City;

/**
 * Class CityToUuidTransformer
 *
 * @package MyHammer\Job\Form\DataTransformer
 */
class CityToUuidTransformer extends EntityToUuidTransformer
{
    /**
     * CityToUuidTransformer constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, City::class);
    }
}
