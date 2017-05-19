<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 17/05/2017
 * Time: 15:16
 */

namespace TrajetsBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TrajetsSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', 'datetime',
                ['label' => 'Date de début de recherche',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yy',
                    'attr' => [
                        'class' => 'form-control col-lg-6',
                        'placeholder' => 'JJ/MM/YYYY'
                    ]
                ])
            ->add('dateFin', 'datetime',
                ['label' => 'Date de fin de recherche',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yy',
                    'attr' => [
                        'class' => 'form-control col-lg-6',
                        'placeholder' => 'JJ/MM/YYYY'
                    ]
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'trajetsbundle_trajets_search';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}