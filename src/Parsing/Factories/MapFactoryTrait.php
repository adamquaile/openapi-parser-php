<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

trait MapFactoryTrait
{
    protected static function modifyEveryObjectProperty(object &$object, callable $modifier): void
    {
        array_walk(
            $object,
            fn (&$property) => $property = $modifier($property),
        );
    }
}
