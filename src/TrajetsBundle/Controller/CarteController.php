<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 11/04/2017
 * Time: 13:33
 */

namespace TrajetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CarteController extends Controller
{
    public function affichageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TrajetsBundle:Lieu');
        $boutiques = $repository->findBy(array('label' => 'B'));
        $consignes = $repository->findBy(array('label' => 'C'));

        return $this->render('TrajetsBundle:Carte:index.html.twig',
            ['consignes' => $consignes,
                'boutiques' => $boutiques]
        );
    }

}