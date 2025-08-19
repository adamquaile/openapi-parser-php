<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing;

use Psr\Container\ContainerInterface;
use AdamQ\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use AdamQ\OpenApiParser\Exceptions\OpenApiValidationError;
use AdamQ\OpenApiParser\Model\ComponentsObject;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Parsing\Factories\ComponentsObjectFactoryInterface;
use AdamQ\OpenApiParser\Parsing\Factories\InfoObjectFactoryInterface;
use AdamQ\OpenApiParser\Parsing\Factories\OpenApiObjectFactoryInterface;

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
    public function create(string $object, mixed $data, ParseContext $context): ?object
    {
        if (is_null($data)) {
            return null;
        }

        $short = (new \ReflectionClass($object))->getShortName();
        $defaultFactoryInterface = 'AdamQ\\OpenApiParser\\Parsing\\Factories\\' . $short . 'FactoryInterface';

        $factory = $this->container->get($defaultFactoryInterface);

        try {
            return $factory->create($data, $context);
        } catch (OpenApiValidationError $error) {
            throw new InvalidOpenApiDocument([$error]);
        }
    }
}
