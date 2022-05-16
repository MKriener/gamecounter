<?php

declare(strict_types=1);

namespace App\Handler\Game\Create;

use App\Handler\Game\GameInputFilter;
use Laminas\I18n\Validator\IsInt;

class GameCreateInputFilter extends GameInputFilter
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
    }
}
