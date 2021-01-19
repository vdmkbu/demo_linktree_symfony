<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static User|Proxy createOne(array $attributes = [])
 * @method static User[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static User|Proxy findOrCreate(array $attributes)
 * @method static User|Proxy random(array $attributes = [])
 * @method static User|Proxy randomOrCreate(array $attributes = [])
 * @method static User[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static User[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method User|Proxy create($attributes = [])
 */
final class UserFactory extends ModelFactory
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function getDefaults(): array
    {
        return [
            'username' => self::faker()->unique()->userName,
            'email' => self::faker()->unique()->email,
            'password' => 'password',
            'roles' => ['ROLE_USER']
        ];
    }

    protected function initialize(): self
    {
        return $this
             ->afterInstantiate(function(User $user) {
                 $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
             })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
