<?php

namespace HillsModeling\FrontEndBundle\Repository;


class AttributsRepository extends \Doctrine\ORM\EntityRepository
{

    public function FindAttr($id)
    {

        $qb = $this->createQueryBuilder('a');

        $qb ->select('a')
            ->innerJoin('a.projet', 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
        ;
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
