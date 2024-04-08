<?php

namespace App\Repository;

use App\Entity\Exports;
use App\Form\ExportsType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormInterface;

/**
 * @extends ServiceEntityRepository<Exports>
 *
 * @method Exports|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exports|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exports[]    findAll()
 * @method Exports[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exports::class);
    }

    public function createQueryBuilderFromForm(FormInterface $form): QueryBuilder
    {
        $qb = $this->createQueryBuilder('e');
        foreach ($form->all() as $field) {
            match ($field->getName()) {
                'local' => $field->getData() !== null ? $qb->andWhere('e.local = :local')->setParameter('local', $field->getData()) : null,
                'export_at_from' =>  $field->getData() !== null ?$qb->andWhere('e.exportAt >= :export_at_from')->setParameter('export_at_from', $field->getData()) : null,
                'export_at_to' =>  $field->getData() !== null ?$qb->andWhere('e.exportAt <= :export_at_to')->setParameter('export_at_to', $field->getData()) : null,
                'Submit' => null,
            };
        }
        return $qb;
    }
}
