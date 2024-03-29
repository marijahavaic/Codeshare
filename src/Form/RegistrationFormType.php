<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
                'attr' => [
                    'placeholder' => 'Choisissez un nom d\'utilisateur',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom d\'utilisateur',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères',
                        'max' => 20,
                        'maxMessage' => 'Votre nom d\'utilisateur doit contenir au maximum {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9_]+$/',
                        'message' => 'Votre nom d\'utilisateur ne doit contenir que des lettres, des chiffres et des underscores',
                    ]),
                ],
                'attr' => [
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre adresse email doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Votre adresse email doit contenir au maximum {{ limit }} caractères',
                    ]),
                    // new Regex([
                    //     'pattern' => '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
                    //     'message' => 'Veuillez entrer une adresse email valide',
                    // ]),
                ],
                'attr' => [
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre du poste',
                'attr' => [
                    'placeholder' => 'Entrez votre nom de post',
                ],
                'attr' => [
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'À propos',
                'attr' => [
                    'placeholder' => 'Entrez votre nom de post',
                ],
                'attr' => [
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Entrez votre nom ville',
                ],
                'attr' => [
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'attr' => [
                    'placeholder' => 'Entrez votre nom de pays',
                ],
                'attr' => [
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('profile_img', FileType::class, array(
                    'required' => false,
                    'mapped' => false,
                    'required' => false,
            ))
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'J\'accepte les conditions d\'utilisation',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions d\'utilisation',
                    ]),
                ],
                'attr' => [
                    'class' => 'mb-3 mx-3 form-check-input',
                    'checked' => 'checked'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex(
                        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                        message: 'Votre mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial',
                    )
                ],
                'attr' => [
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Créer mon compte',
                'attr' => [
                    'class' => 'mb-3 btn btn-primary'
                ]
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