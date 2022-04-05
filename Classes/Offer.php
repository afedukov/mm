<?php

namespace Classes;

class Offer implements OfferInterface {

	/**
	 * @var array
	 */
	private array $offer;

	/**
	 * @param array $item
	 */
	public function __construct(array $item) {
		$this->offer = $item;
	}

	public function getOfferId(): int {
		return $this->offer["offerId"];
	}

	public function getProductTitle(): string {
		return $this->offer["productTitle"];
	}

	public function getVendorId(): int {
		return $this->offer["vendorId"];
	}

	public function getPrice(): float {
		return $this->offer["price"];
	}
}