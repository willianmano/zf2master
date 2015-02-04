<?php

namespace Core\Entity;

interface EntityInterface
{
	public function exchangeArray($data);
	public static function getIdentifier();
}