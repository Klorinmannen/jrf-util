<?php

declare(strict_types=1);

namespace JRF\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use JRF\Util\Bools;

class BoolsTest extends TestCase
{
	public static function toBooleanProvider(): array
	{
		return [
			[
				'true',
				true
			],
			[
				'false',
				false
			],
			[
				'TRUE',
				true
			],
			[
				'',
				null
			],
			[
				'Trieu',
				null
			]
		];
	}

	#[Test]
	#[DataProvider('toBooleanProvider')]
	public function toBoolean(string $boolString, ?bool $expected): void
	{
		$actual = Bools::toBoolean($boolString);
		$this->assertEquals($expected, $actual);
	}
}
