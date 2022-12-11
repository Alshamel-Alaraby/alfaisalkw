<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static Status PENDING()
 * @method static Status WaitingForFulfillment()
 * @method static Status OutForDelivery()
 * @method static Status DELIVERED()
 * @method static Status CANCELLED()
 * @method static Status RETURNED()
 * @method static Status WAITING_FOR_PAYMENT()
 */

class Status extends Enum
{
    public const PENDING = 'Pending';
    public const REVIEWED = 'Reviewed';
    public const INPROGRESS = 'In Progress';
    public const FINISHED = 'Finished';
    public const CANCELLED = 'Cancelled';
}
