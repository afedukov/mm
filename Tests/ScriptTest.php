<?php

namespace Tests;

use Classes\Script;

class ScriptTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @param $command
	 * @param $expected
	 * @param $actual
	 *
	 * @dataProvider provider
	 */
	public function testCountByPriceRange($command, $expected, $actual) {
		$this->assertSame($expected, (new Script())->getCount($command, $actual));
	}

	public function testEx() {
		$this->expectException(\InvalidArgumentException::class);

		(new Script())->getCount("invalid_command", []);
	}

	public function provider(): array {
		return [
			["count_by_price_range", 1, [200, 250]],
			["count_by_price_range", 3, [0, 400]],
			["count_by_price_range", 2, [200, 400]],
			["count_by_price_range", 0, [0, 0]],
			["count_by_vendor_id", 0, [0]],
			["count_by_vendor_id", 2, [35]],
			["count_by_vendor_id", 1, [84]],
		];
	}
}