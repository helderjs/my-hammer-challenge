<?php

declare(strict_types=1);

namespace MyHammer\Job\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use MyHammer\Job\Entity\City;
use MyHammer\Job\Repository\CityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CityController
 *
 * @package MyHammer\Job\Controller
 *
 * @Rest\Version("v1")
 */
class CityController implements ClassResourceInterface
{
    /**
     * @var CityRepository
     */
    private $repository;

    /**
     * CityController constructor.
     *
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     *
     * @Rest\Get(path="/city")
     * @Rest\View
     */
    public function getCitiesAction(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param string $zipCode
     * @return City
     *
     * @Rest\Get(path="/city/zipcode/{zipCode}")
     * @Rest\View
     */
    public function getCityByZipCodeAction(string $zipCode): City
    {
        $city = $this->repository->findOneByZipCode($zipCode);

        if (null === $city) {
            throw new NotFoundHttpException(sprintf('City with zip code %s not found', $zipCode));
        }

        return $city;
    }
}
