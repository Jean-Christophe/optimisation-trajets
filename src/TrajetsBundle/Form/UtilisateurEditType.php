<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 04/05/2017
 * Time: 18:38
 */

namespace TrajetsBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UtilisateurEditType extends UtilisateurType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
        ->add('role_utilisateur', 'choice', [
            'mapped' => false,
            'label' => 'Rôle',
            'attr' => ['class' => 'form-control'],
            'choices' => [
                'ROLE_COLLECTEUR' => 'Collecteur',
                'ROLE_ADMIN' => 'Administrateur'
            ]
        ]);
    }
}