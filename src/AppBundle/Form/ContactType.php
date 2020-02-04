<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
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
            ]
        );

        $builder->add(
            'lastName',
            TextType::class,
            [
                'label' => 'contact.entity.lastName',
                'required' => true,
            ]
        );

        $builder->add(
            'birthday',
            BirthdayType::class,
            [
                'label' => 'contact.entity.birthday',
            ]
        );

        $builder->add('email', EmailType::class, [
            'label' => 'contact.entity.mail',
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
            ]
        );

        $builder->add(
            'zip',
            TextType::class,
            [
                'label' => 'contact.entity.zip',
            ]
        );

        $builder->add(
            'city',
            TextType::class,
            [
                'label' => 'contact.entity.city',
            ]
        );

        $builder->add(
            'country',
            TextType::class,
            [
                'label' => 'contact.entity.country',
            ]
        );

        $builder->add('phoneNumber', PhoneNumberType::class, [
            'label' => 'contact.entity.phoneNumber',
            'constraints' => [
                new NotBlank(),
                new PhoneNumber()
            ],
            'attr' => [
                'description' => 'contact.entity.phoneNumber'
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
