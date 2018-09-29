<?php
// src/AppBundle/Entity/User.php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

class ClientRepository extends EntityRepository
{
  public function findByusername($username) {
             $qb=$this->createQueryBuilder('p');
            $qb->where('p.username like :username')
               ->orderBy('p.date')     
                    ->setParameter('username', $username);
                 
            return $qb->getQuery()->getSingleScalarResult();
    }
    
    
   public function getNbmales() {
             $qb=$this->createQueryBuilder('p');
             $qb ->select('COUNT(p.sexe)')  
                 ->where('p.sexe=1');
                
                 
                 
            return $qb->getQuery()->getSingleScalarResult();
    }
    
     public function getNbfemales() {
             $qb=$this->createQueryBuilder('p');
             $qb ->select('COUNT(p.sexe)')  
                 ->where('p.sexe=0');
                
                 
                 
            return $qb->getQuery()->getResult();
    }
}