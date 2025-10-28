<?php

namespace Application\Department\UseCases;

use Symfony\Component\Validator\Constraints as Assert;

final class GetDepartmentByIpUseCase
{
    #[Assert\Valid]
    #[Assert\NotBlank(message: 'Ip is required.')]
    public string $ip;
}
