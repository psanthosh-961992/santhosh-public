<?php

namespace App\Repository;

use App\Entity\Articles;

use App\Entity\BmlMaster;
use App\Entity\BmlFfData;

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
        dd($queryBuilder->getQuery());
        return $queryBuilder->getQuery()->getResult();
    }

    public function SearchDynamicDataByinput($input = []): Array
    {
        $queryBuilder =  $this->entity_manager->createQueryBuilder()
                            ->select(['bmlmaster.bmlPkid','bmlmaster.partCode','bmlmaster.description',
                            'bmlmaster.preferredMaterial','bmlffdata.paramName','bmlffdata.paramValue','bmlffdata.bmlFfdPkid'])
                            ->from(BmlMaster::class, 'bmlmaster')
                            ->Join(BmlFfData::class, 'bmlffdata', 'WITH', ' bmlffdata.bmlFkid = bmlmaster.bmlPkid');

        return $queryBuilder->getQuery()->getResult();
    }
}
