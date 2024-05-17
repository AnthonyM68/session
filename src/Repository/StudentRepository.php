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
    //  SELECT * 
    //  FROM student 
    //  WHERE id_student
    //  NOT IN (SELECT id_student FROM session_student WHERE session_id = : session_id)

    public function findNotRegister($sessionId): array
    {
        $em = $this->getEntityManager(); //em=EntityManager ()

        //  instance de QueryBuilder
        // permet de construire dynamiquement des requêtes SQL de manière programmatique.
        $qb = $em->createQueryBuilder();

        // on recherche tous les étudiants (s) qui sont liés à une session (se) spécifique,
        $qb->select('s') //s=student
            ->from('App\Entity\Student', 's')
            ->leftJoin('s.sessions', 'se')
            ->where('se.id = :id');
        //  nouvelle instance de QueryBuilder
        $sub = $em->createQueryBuilder();
        /**
         * sous-requête pour trouver les étudiants non inscrits à cette session :
         * sous-requête est créée pour sélectionner tous les étudiants (st) dont 
         * l'ID n'est pas dans les résultats de la première requête. Cela signifie 
         * qu'ils ne sont pas inscrits à la session spécifique.
         */
        $sub->select('st')
            ->from('App\Entity\Student', 'st')
            ->where($sub->expr()->notIn('st.id', $qb->getDQL()))
            ->setParameter('id', $sessionId)
            ->orderBy('st.firstName');
        // on retourne le resultat
        $query = $sub->getQuery();
        return $query->getResult();
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
