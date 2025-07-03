<?php

namespace App\Enums;

enum UserRolesEnum: int
{
    case Customer = 3;
    case Cashier = 2;
    case Owner = 1;
}
