<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 17/05/2017
 * Time: 15:49
 */

namespace TrajetsBundle\Repository;


class TrajetRepository extends \Doctrine\ORM\EntityRepository
{
    public function getTrajetsByDates($dateDebut, $dateFin)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
          'SELECT t FROM TrajetsBundle:Trajet t WHERE t.dateDepart >= :dateDepart AND ' .
                  '(t.dateArriveePrevue <= :dateFin OR t.dateArrivee <= :dateFin)'
        );
        $query->setParameter('dateDepart', $dateDebut);
        $query->setParameter('dateFin', $dateFin);
        return $query->getResult();
    }

    public function getTrajetsEnCours()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT t FROM TrajetsBundle:Trajet t WHERE t.estEffectue = FALSE AND t.estActif = TRUE'
        );
        return $query->getResult();
    }

    public function getLastTrajetByUtilisateur($utilisateur)
    {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('t')
            ->from('TrajetsBundle:Trajet', 't')
            ->where('t.utilisateur = :utilisateur')
            ->setParameter('utilisateur', $utilisateur)
            ->orderBy('t.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery();
        return $query->getOneOrNullResult();
    }
}