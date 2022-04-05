<?php

namespace Classes;

/**
 * Interface of Data Transfer Object, that represents external JSON data
 */
interface OfferInterface {

	public function getOfferId(): int;

	public function getProductTitle(): string;

	public function getVendorId(): int;

	public function getPrice(): float;
}