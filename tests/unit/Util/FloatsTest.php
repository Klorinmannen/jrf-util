<?php

declare(strict_types=1);

namespace JRF\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use JRF\Util\Floats;

class FloatsTest extends TestCase
{
	public static function isFloatProvider(): array
	{
		return [
			[
				'1.1',
				true
			],
			[
				'1',
				false
			],
			[
				1.1,
				true
			],
			[
				1,
				false
			],
			[
				'',
				false
			]
		];
	}

	#[Test]
	#[DataProvider('isFloatProvider')]
	public function isFloat(string|int|float $subject, bool $expected): void
	{
		$actual = Floats::isFloat($subject);
		$this->assertEquals($expected, $actual);
	}
}
