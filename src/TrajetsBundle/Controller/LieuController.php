<?php

namespace TrajetsBundle\Controller;

use Symfony\Component\Form\FormError;
use TrajetsBundle\Entity\Lieu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Lieu controller.
 *
 */
class LieuController extends Controller
{
    /**
     * Lists all lieu entities.
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TrajetsBundle:Lieu');
        $boutiques = $repository->findBy(array('label' => 'B'));
        $consignes = $repository->findBy(array('label' => 'C'));

        return $this->render('lieu/index.html.twig', array(
            'boutiques' => $boutiques,
            'consignes' => $consignes
        ));
    }

    /**
     * Creates a new lieu entity.
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $lieu = new Lieu();
        $form = $this->createForm('TrajetsBundle\Form\LieuType', $lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $latitude = $lieu->getLatitude();
                $latitude = str_replace(',', '.', $latitude);
                $latitude = floatval($latitude);
                if($latitude == 0){
                    throw new \Exception('La latitude n\'est pas valide', '0');
                }

                $longitude = $lieu->getLongitude();
                $longitude = str_replace(',', '.', $longitude);
                $longitude = floatval($longitude);
                if($longitude == 0){
                    throw new \Exception('La longitude n\'est pas valide', '1');
                }
                $lieu->setLatitude($latitude);
                $lieu->setLongitude($longitude);

                $em = $this->getDoctrine()->getManager();
                $em->persist($lieu);
                $em->flush();

                return $this->redirectToRoute('lieux_show', array('id' => $lieu->getId()));
            }catch (\Exception $e)
            {
                if($e->getCode() == 0)
                {
                    $form->get('latitude')->addError(new FormError($e->getMessage()));
                }
                if($e->getCode() == 1)
                {
                    $form->get('longitude')->addError(new FormError($e->getMessage()));
                }
            }
        }

        return $this->render('lieu/new.html.twig', array(
            'lieu' => $lieu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lieu entity.
     * @Security("has_role('ROLE_USER')")
     */
    public function showAction(Lieu $lieu)
    {
        $deleteForm = $this->createDeleteForm($lieu);

        return $this->render('lieu/show.html.twig', array(
            'lieu' => $lieu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lieu entity.
     * @Security("has_role('ROLE_USER')")
     */
    public function editAction(Request $request, Lieu $lieu)
    {
        $deleteForm = $this->createDeleteForm($lieu);
        $editForm = $this->createForm('TrajetsBundle\Form\LieuType', $lieu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lieux_edit', array('id' => $lieu->getId(), 'message' => 'La modification a été effectuée avec succès.'));
        }

        return $this->render('lieu/edit.html.twig', array(
            'lieu' => $lieu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a lieu entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Lieu $lieu)
    {
        $form = $this->createDeleteForm($lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lieu);
            $em->flush();
        }

        return $this->redirectToRoute('lieux_index');
    }

    /**
     * Creates a form to delete a lieu entity.
     *
     * @param Lieu $lieu The lieu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lieu $lieu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lieux_delete', array('id' => $lieu->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
