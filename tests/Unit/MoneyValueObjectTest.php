<?php

namespace Tests\Unit;

use Domain\ValueObjects\MoneyValueObject;
use PHPUnit\Framework\TestCase;

class MoneyValueObjectTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_from_german_string(): void
    {
        $this->assertEquals(MoneyValueObject::fromInt(200),
                            MoneyValueObject::fromString('2,00'));
    }

    public function test_create_from_string_without_cents(): void
    {
        $this->assertEquals(MoneyValueObject::fromInt(200),
                            MoneyValueObject::fromString('2'));
    }

    public function test_create_from_string_with_only_one_digit_after_comma(): void
    {
        $this->assertEquals(MoneyValueObject::fromInt(250),
                            MoneyValueObject::fromString('2,5'));
    }

    public function test_convert_to_string_with_comma_separator(): void
    {
        $this->assertEquals('2,00',
                            MoneyValueObject::fromInt(200)->toString());
    }

    public function test_convert_to_string_when_less_then_one_euro(): void
    {
        $this->assertEquals('0,50',
                            MoneyValueObject::fromInt(50)->toString());
    }

    public function test_is_equal_to_same_value(): void
    {
        $this->assertTrue(
            MoneyValueObject::fromInt(50)->isEqualTo(
            MoneyValueObject::fromInt(50))
        );
    }

    public function test_is_not_equal_to_different_value(): void
    {
        $this->assertFalse(
            MoneyValueObject::fromInt(55)->isEqualTo(
            MoneyValueObject::fromInt(50))
        );
    }
}
