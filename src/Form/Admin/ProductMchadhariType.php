<?php

namespace App\Form\Admin;

use App\Entity\Concerne;
use App\Entity\Product;
use App\Entity\Productcategory;
use App\Repository\ConcerneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductMchadhariType extends AbstractType
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
            ->add('shortdescription')
            ->add('strongpoints')
            ->add('price')
            ->add('origin')
            ->add('availablity')
            ->add('categories')

            //NEUF, OCCASION ?
            ->add('productcondition', ChoiceType::class, [
                'required' => true,
                'choices' => array_flip(Product::$productconditions)
            ])

            ->add('colors')
            ->add('fichiersImage', FileType::class, [
                'required'    => false,
                'multiple' => true,
                'label' => "Images"
            ])
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
