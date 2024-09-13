<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

trait SpecificationExtensionFactoryTrait
{
    public function parsedExtensionObject(object $data): ?object
    {
        $extensions = (object) [];
        foreach ($data as $key => $value) {
            if (str_starts_with($key, 'x-')) {
                $keyWithoutPrefix = substr($key, 2);
                $extensions->$keyWithoutPrefix = $value;
            }
        }

        return $extensions;
    }
}
