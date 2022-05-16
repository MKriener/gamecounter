<?php

declare(strict_types=1);

namespace App\Handler\Game;

use Laminas\I18n\Validator\Alnum;
use Laminas\InputFilter\InputFilter;

class GameNameInputFilter extends InputFilter
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
    }
}
