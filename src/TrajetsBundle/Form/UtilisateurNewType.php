<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 04/05/2017
 * Time: 18:32
 */

namespace TrajetsBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class UtilisateurNewType extends UtilisateurType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('password', 'repeated',
        ['type' => 'password',
            'label' => false,
            'options' => ['attr' => ['class' => 'form-control']],
            'first_options' => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Confirmer']])
        ->add('roles', 'collection',
            ['label' => 'Rôle',
                'entry_type' => 'choice',
                'entry_options' =>
                    ['label' => false,
                        'attr' => ['class' => 'form-control'],
                        'choices' => [
                            'ROLE_COLLECTEUR' => 'Collecteur',
                            'ROLE_ADMIN' => 'Administrateur'
                        ]
                    ]
            ]
        );
    }
}