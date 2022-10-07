<?php

namespace App\Form\Admin;

use App\Entity\Concerne;
use App\Entity\Product;
use App\Repository\ConcerneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    private $concerneRepo;
    public function __construct(ConcerneRepository $concerneRepository)
    {
        $this->concerneRepo = $concerneRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation')

            /*
             ->add('concernes', EntityType::class, [
                'class' => Concerne::class,
                'choice_label' => function(Concerne $concerne) {
                    return sprintf('%s', $concerne->getDesignation());
                },
                'choices' => $this->concerneRepo->findAll(),
                'required' => true,
                'multiple' => true,
                'placeholder' => 'Selectionner'
            ])
             */
            ->add('miniDescription')
            ->add('price')
            ->add('vetementTaille')

            /*
             ->add('genre', ChoiceType::class, [
                'required' => true,
                'choices' => array_flip(Product::$genres)
            ])
             */
            ->add('colors')
            ->add('concernes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
        /*
         $resolver->setRequired([
            'update',
        ]);
         */
    }
}
