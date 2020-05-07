<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'userName',
                TextType::class,
                array(
                    'attr' =>
                    array(
                        'class' => 'input'
                    ),
                )
            )
            ->add(
                'password',
                PasswordType::class,
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
                'register',
                ButtonType::class,
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
