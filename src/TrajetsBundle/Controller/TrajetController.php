<?php

namespace TrajetsBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use TrajetsBundle\Entity\Trajet;
use TrajetsBundle\Form\TrajetsSearchType;

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
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new TrajetsSearchType());
        $formTrajetsEnCours = $this->createFormBuilder()
            ->add('validerEnCours', SubmitType::class,
                [
                    'label' => 'Visualiser les trajets en cours',
                    'attr' => ['class' => 'btn btn-lg btn-success']
                ]
            )
            ->getForm();

        if($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if($form->isSubmitted() and $form->isValid())
            {
                $data = $form->getData();
                $dateDebut = $data['dateDebut'];
                $dateFin = $data['dateFin'];
                $trajets = $em->getRepository('TrajetsBundle:Trajet')->getTrajetsByDates($dateDebut, $dateFin);
                return $this->render('trajet/index.html.twig', array(
                    'trajets' => $trajets
                ));
            }

            $formTrajetsEnCours->handleRequest($request);
            if($formTrajetsEnCours->isSubmitted() and $formTrajetsEnCours->isValid())
            {
                $trajets = $em->getRepository('TrajetsBundle:Trajet')->getTrajetsEnCours();
                return $this->render('trajet/index.html.twig', array(
                    'trajets' => $trajets,
                    'enCours' => true
                ));
            }
        }

        return $this->render('trajet/index.html.twig', array(
            'form' => $form->createView(),
            'formTrajetsEnCours' => $formTrajetsEnCours->createView()
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
            $origine = $request->get('origine');

            $destinationTableau = $request->get('destination');
            $destinationId = $destinationTableau['id'];
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('TrajetsBundle:Lieu');
            $destination = $repo->find($destinationId);

            $etapes = [];
            $etapesTableau = $request->get('etapes');
            $etapesTableauLength = count($etapesTableau);
            for($i = 0; $i < $etapesTableauLength; $i++)
            {
                $etape = $repo->find($etapesTableau[$i]);
                $etapes[$i] = $etape;
            }

            $dateDepart = new \DateTime();
            $dateDepart->setTimestamp(intval($request->get('dateDepart')));
            $dateArriveePrevue = new \DateTime();
            $dateArriveePrevue->setTimestamp(intval($request->get('dateArriveePrevue')));

            $trajet = new Trajet();
            $trajet->setOrigine($origine);
            $trajet->setDestination($destination);
            $trajet->setEtapes($etapes);
            $trajet->setDateDepart($dateDepart);
            $trajet->setDateArriveePrevue($dateArriveePrevue);
            $trajet->setUtilisateur($this->getUser());
            $trajet->setEstActif(true);
            $trajet->setEstEffectue(false);

            $em->persist($trajet);
            $em->flush();
            return new Response($request->get("origine"));
        }
        else
        {
            return $this->redirectToRoute('trajets_index');
        }
    }

    public function cancelAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('TrajetsBundle:Trajet');
            $trajet = $repo->getLastTrajetByUtilisateur($this->getUser());
            $trajet->setEstActif(false);
            $em->persist($trajet);
            $em->flush();
            return new Response('Cancel OK');
        }
        else
        {
            return $this->redirectToRoute('trajets_index');
        }
    }

    public function confirmAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('TrajetsBundle:Trajet');
            $trajet = $repo->getLastTrajetByUtilisateur($this->getUser());
            $trajet->setEstActif(false);
            $trajet->setEstEffectue(true);
            $trajet->setDateArrivee(new \DateTime());
            $em->persist($trajet);
            $em->flush();
            return new Response('Confirm OK');
        }
        else
        {
            return $this->redirectToRoute('trajets_index');
        }
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
