<?php

namespace Classes;

/**
 * The interface provides the contract for different readers
 * E.g. it can be XML/JSON Remote Endpoint, or CSV/JSON/XML local files
 */
interface ReaderInterface {

	/**
	 * Read in incoming data and parse to objects
	 *
	 * @param string $input
	 *
	 * @return OfferCollectionInterface
	 */
	public function read(string $input): OfferCollectionInterface;
}