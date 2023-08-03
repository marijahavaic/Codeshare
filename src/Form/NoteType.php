<?php

namespace App\Form;

use App\Entity\Note;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Rédigez votre titre juste ici',
                    'class' => 'mb-3 form-control'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Rédigez votre message',
                'attr' => [
                    'placeholder' => 'Rédigez votre message juste ici',
                    'class' => 'mb-3 form-control'
                ],
            ])
            ->add('isPublished', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Publié',
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'attr' => [
                    'class' => 'my-3'
                ]
                ])
            ->add('createdAt', DateType::class, [
                'label' => 'Créée',
                'placeholder' => [
                'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ],
                'attr' => [
                    'class' => 'my-3'
                ]
            ])
            ->add('editedAt', DateType::class, [
                'label' => 'Modifié',
                'placeholder' => [
                'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ],
                'attr' => [
                    'class' => 'my-3'
                ]
            ])
            ->add('user')
            ->add('button', SubmitType::class, [
                'label' => 'Créer ma note',
                'attr' => [
                    'class' => 'my-3 btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
