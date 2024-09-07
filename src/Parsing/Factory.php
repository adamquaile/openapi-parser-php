<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing;

use Psr\Container\ContainerInterface;
use Worq\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use Worq\OpenApiParser\Exceptions\OpenApiValidationError;
use Worq\OpenApiParser\Model\ComponentsObject;
use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Parsing\Factories\ComponentsObjectFactoryInterface;
use Worq\OpenApiParser\Parsing\Factories\InfoObjectFactoryInterface;
use Worq\OpenApiParser\Parsing\Factories\OpenApiObjectFactoryInterface;

readonly class Factory
{
    public function __construct(
         private ?ContainerInterface $container = new FactoryLocator(),
    ) {
    }

    /**
     * @template T
     * @param class-string<T> $object
     * @param array $data
     * @param ParseContext $context
     * @return T
     */
    public function create(string $object, array $data, ParseContext $context): object
    {
        $short = (new \ReflectionClass($object))->getShortName();
        $defaultFactoryInterface = 'Worq\\OpenApiParser\\Parsing\\Factories\\' . $short . 'FactoryInterface';

        $factory = $this->container->get($defaultFactoryInterface);

        try {
            return $factory->create($data, $context);
        } catch (OpenApiValidationError $error) {
            throw new InvalidOpenApiDocument([$error]);
        }
    }
}
