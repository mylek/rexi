<?php

namespace Common\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($username) {
       return $this->getEntityManager()
         ->createQuery('SELECT u FROM
         CommonUserBundle:User u
         WHERE u.username = :username
         OR u.email = :username')
         ->setParameters(array(
                       'username' => $username
                        ))
         ->getOneOrNullResult();
    }
 
    public function refreshUser(UserInterface $user) {
        return $this->loadUserByUsername($user->getUsername());
    }
 
    public function supportsClass($class) {
        return $class === 'Common\UserBundle\Entity\User';
    }
    
    public function getQueryBuilder(array $params = array()){
        $qb = $this->createQueryBuilder('u')
                        ->select('u.id, u.username, u.email, u.typ, i.imie, i.nazwisko, i.pesel')
                ->leftJoin('u.info', 'i');
            
        if(!empty($params['orderBy'])){
            $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
            $qb->orderBy($params['orderBy'], $orderDir);
        }
        
        if(!empty($params['userTyp']) && $params['userTyp'] != -1){
            $qb->andWhere('u.typ = :typ')->setParameter('typ', $params['userTyp']);
        }
        
        if(!empty($params['search'])){
            $searchParam = '%'.$params['search'].'%';
            $qb->andWhere('u.username LIKE :search')->setParameter('search', $searchParam);
        }
            
        return $qb;
    }
}