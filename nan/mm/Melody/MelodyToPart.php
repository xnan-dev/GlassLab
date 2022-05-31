<?php
namespace nan\mm\Melody;
use nan\mm;
use nan\mm\Arrangement;

Functions::Load;

abstract class  MelodyToPart {
	var $melody;

	function __construct() {
		$this->melody=Melody::nw();
	}

	static function nw() {
		return new MelodyToPart();
	}

	function melody() {
		return $this->chord;
	}	

	function withMelody($melody) {
		$toPart=clone $this;
		$toPart->melody=$melody;
		return $toPart;
	}

	abstract function toPart();
}

?>