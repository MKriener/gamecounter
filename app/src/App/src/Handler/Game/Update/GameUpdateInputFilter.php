<?php

declare(strict_types=1);

namespace App\Handler\Game\Update;

use App\Handler\Game\GameInputFilter;
use Laminas\Validator\Date;

class GameUpdateInputFilter extends GameInputFilter
{
    public function init(): void
    {
        parent::init();

        $this->add(
            [
                'name' => 'playedLast',
                'validators'  => [
                    [
                        'name' => Date::class,
                        'options' => [
                            'format' => 'Y-m-d',
                            'strict' => true,
                        ],
                    ],
                ],
            ]
        );
    }
}
