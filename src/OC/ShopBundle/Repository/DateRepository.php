<?php

namespace OC\ShopBundle\Repository;

/**
 * DateRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DateRepository extends \Doctrine\ORM\EntityRepository
{
    public function getTicketsFor(\DateTime $date)
    {
        return $this->createQueryBuilder('d')
            ->select('COUNT(d)')
            ->where('d.date = :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getSingleScalarResult()
            ;
}
}
