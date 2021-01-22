<?php

namespace App\Factory;

use App\Entity\Visit;
use App\Repository\VisitRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Visit|Proxy createOne(array $attributes = [])
 * @method static Visit[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Visit|Proxy findOrCreate(array $attributes)
 * @method static Visit|Proxy random(array $attributes = [])
 * @method static Visit|Proxy randomOrCreate(array $attributes = [])
 * @method static Visit[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Visit[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static VisitRepository|RepositoryProxy repository()
 * @method Visit|Proxy create($attributes = [])
 */
final class VisitFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'userAgent' => self::faker()->userAgent,
            'createdAt' => self::faker()->dateTime()
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Visit $visit) {})
        ;
    }

    protected static function getClass(): string
    {
        return Visit::class;
    }
}
