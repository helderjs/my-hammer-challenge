<?php

declare(strict_types=1);

namespace MyHammer\Job\Form;

use MyHammer\Job\Entity\Job;
use MyHammer\Job\Form\DataTransformer\CategoryToUuidTransformer;
use MyHammer\Job\Form\DataTransformer\CityToUuidTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class JobType
 *
 * @package MyHammer\Job\Form
 */
class JobType extends AbstractType
{
    /**
     * @var CityToUuidTransformer
     */
    private $cityToUuidTransformer;

    /**
     * @var CategoryToUuidTransformer
     */
    private $categoryToUuidTransformer;

    /**
     * JobType constructor.
     *
     * @param CityToUuidTransformer $cityToUuidTransformer
     * @param CategoryToUuidTransformer $categoryToUuidTransformer
     */
    public function __construct(
        CityToUuidTransformer $cityToUuidTransformer,
        CategoryToUuidTransformer $categoryToUuidTransformer
    ) {
        $this->cityToUuidTransformer = $cityToUuidTransformer;
        $this->categoryToUuidTransformer = $categoryToUuidTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Job::class,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'constraints' => [
                    new NotBlank(),
                ]
            ]
        )
            ->add(
                'description',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'invalid_message' => 'This is not a valid UUID.',
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'category',
                TextType::class,
                [
                    'invalid_message' => 'This is not a valid UUID.',
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'executionDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'constraints' => [
                        new NotBlank(),
                        new Date(),
                    ]
                ]
            );

        $builder->get('city')
            ->addModelTransformer($this->cityToUuidTransformer);
        $builder->get('category')
            ->addModelTransformer($this->categoryToUuidTransformer);
    }
}
