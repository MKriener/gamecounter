<?php

declare(strict_types=1);

namespace App\Handler\Game;

use Laminas\I18n\Validator\Alnum;
use Laminas\I18n\Validator\IsInt;
use Laminas\InputFilter\InputFilter;

class GameInputFilter extends InputFilter
{
    public function init(): void
    {
        $this->add(
            [
                'name' => 'name',
                'validators' => [
                    [
                        'name' => Alnum::class,
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name' => 'description',
                'validators' => [
                    [
                        'name' => Alnum::class,
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name' => 'playerMin',
                'validators' => [
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
                'name' => 'playerMax',
                'validators' => [
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
                'name' => 'startAge',
                'validators' => [
                    [
                        'name' => IsInt::class,
                        'options' => [
                            'strict' => true,
                        ],
                    ],
                ],
            ]
        );
    }
}
