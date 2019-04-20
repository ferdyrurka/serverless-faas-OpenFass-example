<?php
declare(strict_types=1);

namespace App\Tests\validator;

use App\validator\UsernameValidator;
use PHPUnit\Framework\TestCase;

class UsernameValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function validateFailedWhiteSpace(): void {
        $this->assertFalse(UsernameValidator::validate('ferdyrurka  '));
    }

    /**
     * @test
     */
    public function validateFailedSpecialChars(): void {
        $this->assertFalse(UsernameValidator::validate('ferdyrurka%%%'));
    }

    /**
     * @test
     */
    public function validateOk(): void {
        $this->assertTrue(UsernameValidator::validate('Ferdyrurka'));
    }
}

