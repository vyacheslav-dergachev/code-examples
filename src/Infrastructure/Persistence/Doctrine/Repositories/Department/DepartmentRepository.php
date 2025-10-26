<?php

namespace Infrastructure\Persistence\Doctrine\Repositories\Department;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Department\Collections\DepartmentCollection;
use Domain\Department\Entities\Department;
use Domain\Department\Repositories\DepartmentRepositoryInterface;
use Domain\SeedWork\Id\Uuid;

final readonly class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(Department $department): void
    {
        $this->entityManager->persist($department);
        $this->entityManager->flush();
    }

    /** @inheritDoc */
    public function saveAll(array $departments): void
    {
        foreach ($departments as $department) {
            $this->entityManager->persist($department);
        }

        $this->entityManager->flush();
    }

    public function delete(Department $department): void
    {
        $this->entityManager->remove($department);
        $this->entityManager->flush();
    }

    public function findById(Uuid $id): ?Department
    {
        return $this->entityManager
            ->getRepository(Department::class)
            ->findOneBy(['id' => $id->toBinary()]);
    }

    public function findAll(): DepartmentCollection
    {
        $departments = $this->entityManager->getRepository(Department::class)->findAll();

        return new DepartmentCollection(new ArrayCollection($departments));
    }

    public function findByCity(string $city): ?Department
    {
        return $this->entityManager
            ->getRepository(Department::class)
            ->findOneBy(['city' => $city]);
    }
}
