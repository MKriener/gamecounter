<?php

declare(strict_types=1);

namespace App\Handler\Game\Update;

use App\Handler\Game\GameNameInputFilter;
use Laminas\I18n\Validator\IsInt;
use Laminas\Validator\Date;

class GamePlayedInputFilter extends GameNameInputFilter
{
    public function init(): void
    {
        parent::init();

        $this->add(
            [
                'name'        => 'played',
                'allow_empty' => true,
                'validators'  => [
                    [
                        'name' => IsInt::class,
                        'options' => [
                            'strict' => true,
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'        => 'playedLast',
                'allow_empty' => true,
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
