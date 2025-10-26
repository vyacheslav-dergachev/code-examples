<?php

namespace Application\Route\ValueObjects;

/**
 * !WARNING!: When changing, it must also be changed in the swagger.config.js
 */
enum RoutePrefix: string
{
    case Guest = 'guest_api_';
}
