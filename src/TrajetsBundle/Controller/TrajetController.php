<?php

namespace TrajetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Date;
use TrajetsBundle\Entity\Lieu;
use TrajetsBundle\Entity\Trajet;
use TrajetsBundle\Form\TrajetType;

/**
 * Trajet controller.
 *
 */
class TrajetController extends Controller
{
    /**
     * Lists all Trajet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trajets = $em->getRepository('TrajetsBundle:Trajet')->findAll();

        return $this->render('trajet/index.html.twig', array(
            'trajets' => $trajets,
        ));
    }

    /**
     * Creates a new Trajet entity.
     *
     */
    public function newAction(Request $request)
    {
        // Vérifie si la méthode Ajax a été utilisée
        if($request->isXmlHttpRequest())
        {
            $trajetJson = json_decode($request->get("data"), true);

            $trajet = new Trajet();
            $trajet->setOrigine($trajetJson['origine']);
            $trajet->setDestination($trajetJson['destination']);
            $trajet->setEtapes($trajetJson['etapes']);
            $trajet->setDateDepart($trajetJson['dateDepart']);
            $trajet->setDateArriveePrevue($trajetJson['dateArriveePrevue']);
            $trajet->setDateArrivee(null);
            $trajet->setUtilisateur($this->getUser());
            $trajet->setEstEffectue(false);
            $trajet->setEstActif(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($trajet);
            $em->flush();
            */
            return new Response($request->get("data"));

            /*
            $lieu = $this->getDoctrine()->getRepository('TrajetsBundle:Lieu')->find(3);
            $utilisateur = $this->getDoctrine()->getRepository('TrajetsBundle:Utilisateur')->find(3);
            $trajet = new Trajet();
            $trajet->setOrigine('test');
            $trajet->setDestination($lieu);
            $trajet->setDateDepart(new Date());
            $trajet->setDateArriveePrevue(new Date());
            $trajet->setUtilisateur($utilisateur);
            $trajet->setEstEffectue(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($trajet);
            $em->flush();
*/

        }
        else
        {
            return $this->redirectToRoute('trajets_index');
        }
/*
        $trajet = new Trajet();
        $form = $this->createForm('TrajetsBundle\Form\TrajetType', $trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trajet);
            $em->flush();

            return $this->redirectToRoute('trajets_show', array('id' => $trajet->getId()));
        }

        return $this->render('trajet/new.html.twig', array(
            'trajet' => $trajet,
            'form' => $form->createView(),
        ));*/
    }

    /**
     * Finds and displays a Trajet entity.
     *
     */
    public function showAction(Trajet $trajet)
    {
        $deleteForm = $this->createDeleteForm($trajet);

        return $this->render('trajet/show.html.twig', array(
            'trajet' => $trajet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Trajet entity.
     *
     */
    public function editAction(Request $request, Trajet $trajet)
    {
        $deleteForm = $this->createDeleteForm($trajet);
        $editForm = $this->createForm('TrajetsBundle\Form\TrajetType', $trajet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trajet);
            $em->flush();

            return $this->redirectToRoute('trajets_edit', array('id' => $trajet->getId()));
        }

        return $this->render('trajet/edit.html.twig', array(
            'trajet' => $trajet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Trajet entity.
     *
     */
    public function deleteAction(Request $request, Trajet $trajet)
    {
        $form = $this->createDeleteForm($trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trajet);
            $em->flush();
        }

        return $this->redirectToRoute('trajets_index');
    }

    /**
     * Creates a form to delete a Trajet entity.
     *
     * @param Trajet $trajet The Trajet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trajet $trajet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trajets_delete', array('id' => $trajet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
