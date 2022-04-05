<?php

namespace Classes;

use JsonMachine\JsonMachine;

class JsonMachineReader implements ReaderInterface {

	/**
	 * Read in incoming data and parse to objects
	 *
	 * @param string $input
	 *
	 * @return OfferCollectionInterface
	 */
	public function read(string $input): OfferCollectionInterface {
		$items = JsonMachine::fromFile($input);

		$offers = new OfferCollection();

		foreach ($items as $item) {
			$offers->add(new Offer($item));
		}

		return $offers;
	}
}