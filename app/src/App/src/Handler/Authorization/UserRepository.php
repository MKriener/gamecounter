<?php

declare(strict_types=1);

namespace App\Handler\Authorization;

use Mezzio\Authentication\DefaultUser;
use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;

use function getenv;
use function hash_equals;

class UserRepository implements UserRepositoryInterface
{
    public function authenticate(string $credential, ?string $password = null): ?UserInterface
    {
        $expectedCredential = getenv('LOGIN');
        $expectedPassword   = getenv('PW');

        if ($expectedCredential === false || $expectedPassword === false) {
            return null;
        }

        if (! hash_equals($credential, $expectedCredential) || ! hash_equals($password, $expectedPassword)) {
            return null;
        }

        return new DefaultUser($credential);
    }
}
