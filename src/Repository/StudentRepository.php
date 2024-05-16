<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Student>
 *
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }
    //  $sql = "SELECT id
    //  FROM student
    //  WHERE id NOT IN (

    //  SELECT student_id
    //  FROM session_student 
    //  WHERE session_id = 1)";

    
    public function getNotRegister($sessionId): array
    {
        //session_student

        $st = $this->createQueryBuilder('session_student: session_student');


        $query = $this->createQueryBuilder('s')
            ->where($query->expr()->notIn('st.id', $st->select('st.student_id')->getDQL()))
            ->setParameter('sessionId', $sessionId)

        ;

        return $query->getQuery()->getSql();
    }

//     public function getNotRegister($sessionId): array
// {
//     $subQuery = $this->_em->createQueryBuilder()
//         ->select('ss.student_id')
//         ->from('YourBundleName:SessionStudent', 'ss')
//         ->where('ss.session_id = :sessionId');

//     $qb = $this->_em->createQueryBuilder();
//     $qb->select('s.id')
//         ->from('YourBundleName:Student', 's')
//         ->where($qb->expr()->notIn('s.id', $subQuery->getDQL()))
//         ->setParameter('sessionId', $sessionId);

//     return $qb->getQuery()->getResult();
// }
//    /**
//     * @return Student[] Returns an array of Student objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Student
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
