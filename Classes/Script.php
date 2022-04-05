<?php

namespace Classes;

class Script {

	const VALID_COMMANDS = [
		"count_by_price_range" => 2,
		"count_by_vendor_id" => 1,
	];

	const LOG_FILENAME = "log.log";

	/**
	 * @param array $options
	 */
	public function run(array $options): void {
		$command = $options[1] ?? null;

		if (array_key_exists($command, self::VALID_COMMANDS)) {
			try {
				$count = $this->getCount($command, array_slice($options, 2, self::VALID_COMMANDS[$command]));
			} catch (\Exception $e) {
				$this->log("Error: " . $e->getMessage());
				die($e->getMessage() . "\n");
			}
		} else {
			die("Usage: php {$options[0]} " . implode("|", array_keys(self::VALID_COMMANDS)) . " {arguments}\n");
		}

		print "Count: {$count}\n";
	}

	/**
	 * @param string $command
	 * @param array $arguments
	 *
	 * @return int
	 */
	public function getCount(string $command, array $arguments): int {
		$this->log($command . " " . implode(" ", $arguments));

		$offers = (new JsonMachineReader())->read("data.json");

		if ($command === "count_by_price_range") {
			if (isset($arguments[0]) && isset($arguments[1]) && is_numeric($arguments[0]) && is_numeric($arguments[1])) {
				return $this->countByPriceRange($offers, $arguments[0], $arguments[1]);
			}
			throw new \InvalidArgumentException("Invalid input parameters");
		} elseif ($command === "count_by_vendor_id") {
			if (isset($arguments[0]) && is_numeric($arguments[0])) {
				return $this->countByVendorId($offers, $arguments[0]);
			}
			throw new \InvalidArgumentException("Invalid input parameters");
		}

		throw new \InvalidArgumentException("Unknown command");
	}

	/**
	 * @param OfferCollectionInterface $offers
	 * @param float $priceFrom
	 * @param float $priceTo
	 *
	 * @return int
	 */
	private function countByPriceRange(OfferCollectionInterface $offers, float $priceFrom, float $priceTo): int {
		$count = 0;

		/** @var OfferInterface $offer */
		foreach ($offers->getIterator() as $offer) {
			if ($offer->getPrice() >= $priceFrom && $offer->getPrice() <= $priceTo) {
				$count++;
			}
		}

		$this->log($count);

		return $count;
	}

	/**
	 * @param OfferCollectionInterface $offers
	 * @param int $vendorId
	 *
	 * @return int
	 */
	private function countByVendorId(OfferCollectionInterface $offers, int $vendorId): int {
		$count = 0;

		/** @var OfferInterface $offer */
		foreach ($offers->getIterator() as $offer) {
			if ($offer->getVendorId() == $vendorId) {
				$count++;
			}
		}

		$this->log($count);

		return $count;
	}

	/**
	 * @param string $message
	 */
	private function log(string $message): void {
		file_put_contents(self::LOG_FILENAME, "[" . date("Y-m-d H:i:s") . "] {$message}\n", FILE_APPEND);
	}
}