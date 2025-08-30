<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => "Nom",
            'mapped' => true,
            'label_attr' => ['class' => 'required'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer votre nom',
                ]),
                new Length([
                    'min' => 1,
                    'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères',
                    'max' => 4096,
                ]),
            ]
        ])
        ->add('firstname', TextType::class, [
            'label' => "Prénom",
            'mapped' => true,
            'label_attr' => ['class' => 'required'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer votre prénom',
                ]),
                new Length([
                    'min' => 1,
                    'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères',
                    'max' => 4096,
                ]),
            ],
        ])
            ->add('email', EmailType::class, [
                'label_attr' => ['class' => 'required'],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label_attr' => ['class' => 'required'],
                'constraints' => [
                    new IsTrue([
                        'message' => "Vous devez accepter les conditions d'utilisation de vos données personnelles.",
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label_attr' => ['class' => 'required'],
                'attr' => ['autocomplete' => 'new-password', 'class' => 'inputPassword'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
