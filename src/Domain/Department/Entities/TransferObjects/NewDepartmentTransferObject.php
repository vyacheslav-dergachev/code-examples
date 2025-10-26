<?php

namespace Domain\Department\Entities\TransferObjects;

use Domain\SeedWork\Id\Uuid;

class NewDepartmentTransferObject
{
    public function __construct(
        public Uuid $id,
        public string $name,
        public string $city,
        public string $phone,
    ) {
    }
}
