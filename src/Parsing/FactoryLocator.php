<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing;

use Psr\Container\ContainerInterface;

final class FactoryLocator implements ContainerInterface
{

    public function get(string $id)
    {
        $class = $this->resolveClass($id);
        return new $class();
    }

    public function has(string $id): bool
    {
        return class_exists($this->resolveClass($id));
    }

    private function resolveClass(string $id): string
    {
        return preg_replace('/Interface$/', '', $id);
    }
}