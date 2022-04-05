<?php

namespace Classes;

use Iterator;

class OfferCollection implements OfferCollectionInterface {

	/**
	 * @var array|OfferInterface[]
	 */
	private array $items;

	/**
	 * @param array $items
	 */
	public function __construct(array $items = []) {
		$this->items = [];

		foreach ($items as $item) {
			$this->items[] = new Offer($item);
		}
	}

	public function add(OfferInterface $offer): void {
		$this->items[] = $offer;
	}

	/**
	 * @param int $index
	 *
	 * @return OfferInterface
	 */
	public function get(int $index): OfferInterface {
		return $this->items[$index];
	}

	/**
	 * @return Iterator
	 */
	public function getIterator(): Iterator {
		return (new \ArrayObject($this->items))->getIterator();
		//return new OfferCollectionIterator($this->items);
	}
}

