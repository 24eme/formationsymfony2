<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
  public function getNbCafeGroupByUser() {

      $query = $this->getEntityManager()->createQuery("
        SELECT u.username ,u.id as id,count(p.nbCafe) as nbGagne, SUM(p.nbCafe) as nbCafe
        FROM \AppBundle\Entity\Pronostic p
        JOIN p.rencontre r
        JOIN p.utilisateur u
        WHERE r.scoreA = p.scoreA
        AND r.scoreB = p.scoreB
        GROUP BY u.id
      ");

      return $query->getResult();
  }

}
