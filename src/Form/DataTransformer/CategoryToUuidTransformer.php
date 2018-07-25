<?php

declare(strict_types=1);

namespace MyHammer\Job\Form\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use MyHammer\Job\Entity\Category;

/**
 * Class CategoryToUuidTransformer
 *
 * @package MyHammer\Job\Form\DataTransformer
 */
class CategoryToUuidTransformer extends EntityToUuidTransformer
{
    /**
     * CategoryToUuidTransformer constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Category::class);
    }
}
