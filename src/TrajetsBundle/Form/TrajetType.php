<?php

namespace TrajetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrajetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('origine')
            //->add('dateDepart', 'datetime')
            //->add('dateArriveePrevue', 'datetime')
            //->add('dateArrivee', 'datetime')
            ->add('estActif', 'choice',
                ['label' => 'Trajet en cours ?',
                    'attr' => ['class' => 'form-control'],
                    'choices' => [
                        true => 'Oui',
                        false => 'Non'
                    ]])
            ->add('estEffectue', 'choice',
                ['label' => 'Trajet clôturé ?',
                    'attr' => ['class' => 'form-control'],
                    'choices' => [
                        true => 'Oui',
                        false => 'Non'
                    ]])
            //->add('destination')
            //->add('etapes')
            //->add('utilisateur')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TrajetsBundle\Entity\Trajet'
        ));
    }
}
