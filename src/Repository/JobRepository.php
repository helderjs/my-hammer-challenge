<?php

declare(strict_types=1);

namespace MyHammer\Job\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;
use MyHammer\Job\Entity\Job;

/**
 * Class JobRepository
 *
 * @package MyHammer\Job\Repository
 */
class JobRepository extends ServiceEntityRepository
{
    /**
     * JobRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @param Job $job
     * @return Job
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Job $job): Job
    {
        $job->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();

        return $job;
    }

    /**
     * @param Job $job
     * @return Job
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Job $job): Job
    {
        $job->setUpdatedAt(new \DateTime());

        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();

        return $job;
    }

    /**
     * @param Job $job
     * @return bool
     */
    public function delete(Job $job): bool
    {
        try {
            $this->getEntityManager()->remove($job);
        } catch (ORMException $exception) {
            return false;
        }

        return true;
    }
}
