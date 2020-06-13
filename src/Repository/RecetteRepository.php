<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
     private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Recette::class);
        $this->manager = $manager;
    }

    // /**
    //  * @return Recette[] Returns an array of Recette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function toArray()
{
    return [
        'id' => $this->getId(),
        'titre' => $this->getTitre(),
        'soustitre' => $this->getSoustitre(),
        'ingredients' => $this->getIngredients(),
        
    ];
}

    public function saveRecette($titre, $soustitre, $ingredients)
    {
        $newRecette = new Recette();

        $newRecette
            ->setTitre($titre)
            ->setSoustitre($soustitre)
            ->setIngredients($ingredients);

        $this->manager->persist($newRecette);
        $this->manager->flush();
    }

    public function updateRecette(Recette $recette): Recette
{
    $this->manager->persist($recette);
    $this->manager->flush();

    return $recette;
}

public function removeRecette(Recette $recette)
    {
        $this->manager->remove($recette);
        $this->manager->flush();
    }

}

