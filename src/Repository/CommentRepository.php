<?php
namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @param $trick
     * @param $currentPage
     * @return Paginator
     */
    public function getCommentsByTrick ($trick, $currentPage) {
        $query = $this->createQueryBuilder("c")
            ->where('c.trick = :id')
            ->setParameter('id', $trick->getId())
        ->orderBy('c.dateAdd','DESC');
        return $this->paginate($query, $currentPage);
    }

    /**
     * @param $sql
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function paginate($sql, $page, $limit = 10)
    {
        $paginator = new Paginator($sql);
        $paginator->getQuery(['id' => 'DESC'])
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit
        return $paginator;
    }
}
