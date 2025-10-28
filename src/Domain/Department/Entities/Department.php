<?php

namespace Domain\Department\Entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Domain\Department\Entities\TransferObjects\NewDepartmentTransferObject;
use Domain\SeedWork\Id\Uuid;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

#[ORM\Table(name: 'departments')]
#[ORM\Entity]
class Department
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private SymfonyUuid $id;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $city;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $phone;

    public function getId(): Uuid
    {
        return Uuid::fromString((string) $this->id);
    }

    public static function createFromTransferObject(NewDepartmentTransferObject $transferObject): self
    {
        $department = new self();
        $department->id = SymfonyUuid::fromString($transferObject->id->toString());
        $department->name = $transferObject->name;
        $department->city = $transferObject->city;
        $department->phone = $transferObject->phone;

        return $department;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
