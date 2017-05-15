<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 28/04/2017
 * Time: 11:32
 */

namespace TrajetsBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use TrajetsBundle\Entity\Utilisateur;
use TrajetsBundle\TrajetsBundle;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roleCollecteur = 'ROLE_COLLECTEUR';
        $roleAdmin = 'ROLE_ADMIN';

        $builder
            ->add('nom', TextType::class, array(
                'label' => 'Nom'
            ))
            ->add('prenom', TextType::class, array(
                'label' => 'Prénom'
            ))
            ->add('roles', CollectionType::class, array(
                    'entry_type' => ChoiceType::class,
                    'entry_options' => array(
                        'label' => false,
                        'choices' => array(
                            'Administrateur' => 'ROLE_ADMIN',
                            'Collecteur' => 'ROLE_COLLECTEUR'
                        )
                    )
                )
            )
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}