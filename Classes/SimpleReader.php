<?php

namespace Classes;

class SimpleReader implements ReaderInterface {

	/**
	 * Read in incoming data and parse to objects
	 *
	 * @param string $input
	 *
	 * @return OfferCollectionInterface
	 */
	public function read(string $input): OfferCollectionInterface {
		$data = file_get_contents($input);

		if ($data !== false) {
			$items = json_decode($data, true);

			if (is_array($items)) {
				return new OfferCollection($items);
			}
		}

		throw new \RuntimeException("Invalid input");
	}
}