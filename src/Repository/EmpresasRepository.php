<?php

namespace App\Repository;

use App\Entity\Empresas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EmpresasRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry){
        parent::__construct($registry, Empresas::class);
    }
}



