<?php

namespace unipro\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubPagesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('route')
            ->add('title', null, [
                'label' => 'Tytuł'
            ])
            ->add('description', null, [
                'label' => 'Zawartość'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'unipro\PageBundle\Entity\PagesContent'
        ]);
    }
}
