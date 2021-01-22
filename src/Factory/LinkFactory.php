<?php

namespace App\Factory;

use App\Entity\Link;
use App\Repository\LinkRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Link|Proxy createOne(array $attributes = [])
 * @method static Link[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Link|Proxy findOrCreate(array $attributes)
 * @method static Link|Proxy random(array $attributes = [])
 * @method static Link|Proxy randomOrCreate(array $attributes = [])
 * @method static Link[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Link[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LinkRepository|RepositoryProxy repository()
 * @method Link|Proxy create($attributes = [])
 */
final class LinkFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->word,
            'url' => self::faker()->url
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Link $link) {})
        ;
    }

    protected static function getClass(): string
    {
        return Link::class;
    }
}
