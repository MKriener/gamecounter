<?php

declare(strict_types=1);

namespace App\Handler\Game\Read;

use Laminas\I18n\Validator\Alnum;
use Laminas\I18n\Validator\IsInt;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\Date;

class GamesReadInputFilter extends InputFilter
{
    public function init(): void
    {
        $this->add(
            [
                'name' => 'name',
                'allow_empty' => true,
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
                'allow_empty' => true,
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
                'allow_empty' => true,
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
                'allow_empty' => true,
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
                'name' => 'lastPlayed',
                'allow_empty' => true,
                'validators' => [
                    [
                        'name' => Date::class,
                        'options' => [
                            'strict' => true,
                        ],
                    ],
                ],
            ]
        );
    }
}
