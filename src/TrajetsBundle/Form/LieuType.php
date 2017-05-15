<?php

namespace TrajetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text',
            ['label' => 'Nom du lieu',
                'attr' => ['class' => 'form-control']])
            ->add('adresse', 'text',
                ['attr' =>['class' => 'form-control']])
            ->add('cpo', 'integer',
                ['label' => 'Code postal',
                    'attr' => ['class' => 'form-control']])
            ->add('ville', 'text',
                ['attr' =>['class' => 'form-control']])
            ->add('latitude', 'text',
                ['attr' =>['class' => 'form-control']])
            ->add('longitude', 'text',
                ['attr' =>['class' => 'form-control']])
            ->add('label', 'choice',
                ['label' => 'Type de lieu',
                    'attr' =>['class' => 'form-control'],
                    'choices' => [
                        'B' => 'Boutique',
                        'C' => 'Consigne'
                    ]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TrajetsBundle\Entity\Lieu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'trajetsbundle_lieu';
    }


}
