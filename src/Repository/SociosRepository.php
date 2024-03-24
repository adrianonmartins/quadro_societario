<?php

namespace App\Repository;

use App\Entity\Socios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SociosRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry){
        parent::__construct($registry, Socios::class);
    }
}