<?php

declare(strict_types=1);

namespace MyHammer\Job\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use MyHammer\Job\Entity\City;


/**
 * Class CityRepository
 *
 * @package MyHammer\Job\Repository
 */
class CityRepository extends ServiceEntityRepository
{
    /**
     * CityRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }
}
