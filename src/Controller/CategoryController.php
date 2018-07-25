<?php

declare(strict_types=1);

namespace MyHammer\Job\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use MyHammer\Job\Entity\Category;
use MyHammer\Job\Repository\CategoryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryController
 *
 * @package MyHammer\Job\Controller
 *
 * @Rest\Version("v1")
 */
class CategoryController implements ClassResourceInterface
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     *
     * @Rest\Get(path="/category")
     * @Rest\View
     */
    public function getCategoriesAction(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param Category $category
     * @return Category
     *
     * @Rest\Get(path="/category/{uuid}")
     * @Rest\View
     */
    public function getCategoryAction(Category $category): Category
    {
        return $category;
    }
}
