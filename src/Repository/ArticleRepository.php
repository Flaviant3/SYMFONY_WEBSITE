<?php
// src/Repository/ArticleRepository.php
namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository
{
public function __construct(ManagerRegistry $registry)
{
parent::__construct($registry, Article::class);
}

public function search($word)
{
return $this->createQueryBuilder('a')
->andWhere('a.titre LIKE :word OR a.texte LIKE :word')
->setParameter('word', '%' . $word . '%')
->getQuery()
->getResult();
}
}
?>