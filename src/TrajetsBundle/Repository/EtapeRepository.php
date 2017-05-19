<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 19/05/2017
 * Time: 12:21
 */

namespace TrajetsBundle\Repository;


class EtapeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByTrajetAndLieu($trajet, $lieu)
    {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('e')
            ->from('TrajetsBundle:Etape', 'e')
            ->where('e.trajet = :trajet', 'e.lieu = :lieu')
            ->setParameter('trajet', $trajet)
            ->setParameter('lieu', $lieu)
            ->getQuery();
        return $query->getOneOrNullResult();
    }
}