<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing;

use Psr\Container\ContainerInterface;
use TypeSlow\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use TypeSlow\OpenApiParser\Exceptions\OpenApiValidationError;
use TypeSlow\OpenApiParser\Model\ComponentsObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Parsing\Factories\ComponentsObjectFactoryInterface;
use TypeSlow\OpenApiParser\Parsing\Factories\InfoObjectFactoryInterface;
use TypeSlow\OpenApiParser\Parsing\Factories\OpenApiObjectFactoryInterface;

readonly class Factory
{
    public function __construct(
         private ?ContainerInterface $container = new FactoryLocator(),
    ) {
    }

    /**
     * @template T of object
     * @param class-string<T> $object
     * @param ParseContext $context
     * @return ?T
     */
    public function create(string $object, ?object $data, ParseContext $context): ?object
    {
        if (is_null($data)) {
            return null;
        }

        $short = (new \ReflectionClass($object))->getShortName();
        $defaultFactoryInterface = 'TypeSlow\\OpenApiParser\\Parsing\\Factories\\' . $short . 'FactoryInterface';

        $factory = $this->container->get($defaultFactoryInterface);

        try {
            return $factory->create($data, $context);
        } catch (OpenApiValidationError $error) {
            throw new InvalidOpenApiDocument([$error]);
        }
    }
}
