<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Support;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\DataProvider;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\Factory;
use Worq\OpenApiParser\Parsing\ParseContext;


trait ObjectFactoryTest
{
    private $factory;

    #[Before]
    public function setupFactoryUnderTest(): void
    {
        $factoryTestClass = (new \ReflectionClass(static::class))->getShortName();
        self::assertStringEndsWith('Test', $factoryTestClass);
        $factoryClass = '\\Worq\\OpenApiParser\\Parsing\\Factories\\' . substr($factoryTestClass, 0, -4);
        $this->factory = new $factoryClass();
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

    #[DataProvider('examples')]
    public function testExamples(Version $version, mixed $data, object $expected): void
    {
        $this->assertEquals(
            $expected,
            $this->factory->create($data, new ParseContext(version: $version, factory: $this->createMock(Factory::class)))
        );
    }

}
