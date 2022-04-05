<?php

namespace Classes;

class OfferCollectionIterator implements \Iterator {

	private array $items;

	private int $position;

	public function __construct(array $items) {
		$this->position = 0;
		$this->items = $items;
	}

	/**
	 * @return mixed
	 */
	public function current() {
		return $this->items[$this->position];
	}

	/**
	 *
	 */
	public function next() {
		$this->position++;
	}

	/**
	 * @return bool|float|int|string|null
	 */
	public function key() {
		return $this->position;
	}

	/**
	 * @return bool
	 */
	public function valid() {
		return isset($this->items[$this->position]);
	}

	/**
	 *
	 */
	public function rewind() {
		$this->position = 0;
	}
}