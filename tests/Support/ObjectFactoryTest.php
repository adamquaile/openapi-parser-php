<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Support;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Parsing\ParseContext;


/**
 * @mixin TestCase
 */
trait ObjectFactoryTest
{
    private $factory;

    #[Before]
    public function setupFactoryUnderTest(): void
    {
        $factoryTestClass = (new \ReflectionClass(static::class))->getShortName();
        self::assertStringEndsWith('Test', $factoryTestClass);
        $factoryClass = '\\TypeSlow\\OpenApiParser\\Parsing\\Factories\\' . substr($factoryTestClass, 0, -4);
        $this->factory = new $factoryClass();
    }

    public function setupPreconditions(Factory&MockObject $factory): void
    {
    }

    /**
     * @return iterable<array-key, array{data: mixed, expected: object}>
     */
    abstract public static function examples();

    public function testImplementsInterface(): void
    {
        $interface = $this->factory::class.'Interface';
        $this->assertInstanceOf($interface, $this->factory);
    }

    /**
     * @return array{data: mixed, expected: object}>
     */
    public static function firstExample(): array
    {
        return array_values(iterator_to_array(self::examples()))[0];
    }

    #[DataProvider('examples')]
    public function testExamples(Version $version, object|string $data, object $expected, ?callable $assert = null): void
    {
        $factory = $this->createMock(Factory::class);
        $this->setupPreconditions($factory);
        $actual = $this->factory->create($data, new ParseContext(version: $version, factory: $factory));

        $this->assertEquals($expected, $actual);

        if (!is_null($assert)) {
            $assert($actual);
        }
    }
}
