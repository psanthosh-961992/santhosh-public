<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public $entity_manager;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, Articles::class);
        $this->entity_manager = $em;
    }

    public function SearchArticlesByinput($input = []): Array
    {
        if( isset($input['search_key']) && trim($input['search_key']) != '' ) {
            $queryBuilder = $this->entity_manager->createQueryBuilder()
                                ->select(['articles.title','articles.body'])
                                ->from(Articles::class, 'articles')
                                ->Where('articles.title LIKE :title')
                                // ->OrWhere('articles.title LIKE :title')
                                ->setParameter('title','%'. $input['search_key']. '%');
        } else {
            $queryBuilder = $this->entity_manager->createQueryBuilder()
                                ->select(['articles.title','articles.body'])
                                ->from(Articles::class, 'articles');
        }
        return $queryBuilder->getQuery()->getResult();
    }
}
