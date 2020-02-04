<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'firstName',
            TextType::class,
            [
                'label' => 'contact.entity.firstName',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );

        $builder->add(
            'lastName',
            TextType::class,
            [
                'label' => 'contact.entity.lastName',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );

        $builder->add(
            'birthday',
            DateType::class,
            [
                'label' => 'contact.entity.birthday',
                'widget' => 'single_text',
                'required' => false,
                'attr' => [
                    'class' => ' form-control date'
                ],
            ]
        );

        $builder->add('email', EmailType::class, [
            'label' => 'contact.entity.email',
            'attr' => [
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(),
                new Email()
            ]
        ]);

        $builder->add(
            'street',
            TextType::class,
            [
                'label' => 'contact.entity.street',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );

        $builder->add(
            'zip',
            TextType::class,
            [
                'label' => 'contact.entity.zip',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );

        $builder->add(
            'city',
            TextType::class,
            [
                'label' => 'contact.entity.city',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );

        $builder->add(
            'country',
            TextType::class,
            [
                'label' => 'contact.entity.country',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );

        $builder->add('phoneNumber', PhoneNumberType::class, [
            'label' => 'contact.entity.phoneNumber',
            'required' => true,
            'constraints' => [
                new NotBlank(),
                new PhoneNumber()
            ],
            'attr' => [
                'class' => 'form-control'
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'contact';
    }
}
