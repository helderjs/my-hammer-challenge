<?php

declare(strict_types=1);

namespace MyHammer\Job\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use MyHammer\Job\DataObject\AddJob;
use MyHammer\Job\Entity\Job;
use MyHammer\Job\Form\JobType;
use MyHammer\Job\Repository\JobRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class JobController
 *
 * @package MyHammer\Job\Controller
 *
 * @Rest\Version("v1")
 */
class JobController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @var JobRepository
     */
    private $repository;

    /**
     * JobController constructor.
     *
     * @param JobRepository $repository
     */
    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     *
     * @Rest\Get(path="/job")
     * @Rest\View
     */
    public function getJobsAction(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param Job $job
     * @return Job
     *
     * @Rest\Get(path="/job/{uuid}")
     * @Rest\View
     */
    public function getJobAction(Job $job): Job
    {
        return $job;
    }

    /**
     * @param Request $request
     * @return Job|FormInterface
     *
     * @Rest\Post(path="/job")
     * @Rest\View(statusCode=201)
     */
    public function addJobAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        return $this->repository->add($job);
    }

    /**
     * @param Request $request
     * @param Job $job
     * @return Job
     *
     * @Rest\Put(path="/job/{uuid}")
     * @Rest\View()
     */
    public function updateJobAction(Request $request, Job $job): Job
    {
        $form = $this->createForm(JobType::class, $job);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        return $this->repository->update($job);
    }

    /**
     * @param Job $job
     * @return void
     *
     * @Rest\Delete(path="/job/{uuid}")
     * @Rest\View
     */
    public function deleteJobAction(Job $job): void
    {
        $this->repository->delete($job);
    }
}
