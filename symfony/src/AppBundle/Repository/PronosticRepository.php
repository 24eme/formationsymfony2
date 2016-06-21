<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PronosticRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PronosticRepository extends EntityRepository
{
    public function getPronosticsByRencontre($idRencontre)
    {
        $qb = $this->createQueryBuilder('entry');
        $qb->select('entry')
          ->where($qb->expr()->eq('entry.rencontre', ':idRencontre')
                  )
          ->orderBy('entry.date', 'ASC')
          ->setParameter('idRencontre', $idRencontre);
        return $qb->getQuery()->getResult();
    }

    public function getPronosticsMatchsNonTermines()
    {
        $query = $this->getEntityManager()
                      ->createQuery("SELECT p, r
                        FROM \AppBundle\Entity\Pronostic p
                        JOIN p.rencontre r
                        WHERE r.date > :date
                        ORDER BY r.date DESC")
                      ->setParameter('date', date('Y-m-d'));
        return $query->getResult();
    }

}
