<?php

namespace HillsModeling\FrontEndBundle\Repository;


class ShemasRepository extends \Doctrine\ORM\EntityRepository
{

    public function FindShema($id)
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
