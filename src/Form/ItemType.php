<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'amount',
                IntegerType::class,
                array(
                    'label' => 'Anzahl',
                    'attr' =>
                    array(
                        'min' => 1,
                        'class' => 'control'
                    ),
                )
            )
            ->add(
                'name',
                TextType::class,
                array(
                    'label' => 'Name',
                    'attr' =>
                    array(
                        'class' => 'control'
                    )
                )
            )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'label' => 'Hinzufügen',
                    'attr' =>
                    array(
                        'class' => 'button is-primary'
                    )
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
