<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EditItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'amount',
                IntegerType::class,
                array(
                    'attr' =>
                    array(
                        'min' => 1,
                        'class' => 'input'
                    ),
                )
            )
            ->add(
                'name',
                TextType::class,
                array(
                    'attr' =>
                    array(
                        'class' => 'input'
                    )
                )
            )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'attr' =>
                    array(
                        'class' => 'button is-primary'
                    )
                )
            )
            ->add(
                'cancel',
                // TODO: ButtonType?
                SubmitType::class,
                array(
                    'attr' =>
                    array(
                        'class' => 'button is-secondary'
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
