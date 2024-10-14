<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 * @method static static OptionFour()
 */
final class StatusEnum extends Enum
{
    const Scheduled = 'Scheduled';
    const NotSchedule = 'Not Schedule';
    const Vaccinated = 'Vaccinated';

    const NotRegistered = 'Not Registered';

}
