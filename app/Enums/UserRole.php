<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRole extends Enum
{
    const SuperAdmin = 'SUPER_ADMIN';
    const Admin = 'ADMIN';
    const Customer = 'CUSTOMER';
}
