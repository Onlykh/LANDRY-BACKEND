<?php

namespace App\Enums;



/**
 * @method static self IN_PROGRESS()
 * @method static self ACCEPTED()
 * @method static self PICKED_UP()
 * @method static self UNDER_TREATMENT()
 * @method static self ON_THE_WAY()
 * @method static self DELIVERED()
 * @method static self FINISHED()
 */
final class OrderStateEnum extends BaseEnumWithColor
{



    protected static function values(): array
    {
        return [
            'IN_PROGRESS' => 'in_progress',
            'ACCEPTED' => 'accepted',
            'PICKED_UP' => 'picked_up',
            'UNDER_TREATMENT' => 'under_treatment',
            'ON_THE_WAY' => 'on_the_way',
            'DELIVERED' => 'delivered',
            'FINISHED' => 'finished',
        ];
    }

    /**
     *
     */
    protected static function labels(): array
    {
        return [
            'IN_PROGRESS' => 'order.state.in_progress',
            'ACCEPTED' => 'order.state.accepted',
            'PICKED_UP' => 'order.state.picked_up',
            'UNDER_TREATMENT' => 'order.state.under_treatment',
            'ON_THE_WAY' => 'order.state.on_the_way',
            'DELIVERED' => 'order.state.delivered',
            'FINISHED' => 'order.state.finished',
        ];
    }

    /**
     *
     */
    protected static function colors(): array
    {
        return [
            'IN_PROGRESS' => 'info',
            'ACCEPTED' => 'primary',
            'PICKED_UP' => 'warning',
            'UNDER_TREATMENT' => 'warning',
            'ON_THE_WAY' => 'warning',
            'DELIVERED' => 'success',
            'FINISHED' => 'success',
        ];
    }
}
