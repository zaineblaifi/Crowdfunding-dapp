<?php

namespace App\Form;

use App\Entity\Subscribers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscriberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email', EmailType::class)
            ->add('agreeTerms', CheckboxType::class, ['mapped'=>false, 'required'=> false])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subscribers::class,
            'csrf_protection'=> true,
            'csrf_field_name'=> '_token',
            'csrf_token_id'=>'subscriber_item'
        ]);
    }
}
