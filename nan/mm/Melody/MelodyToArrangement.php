<?php
namespace nan\mm\Melody;
use nan\mm;
use nan\mm\Arrangement;

Functions::Load;

abstract class  MelodyToArrangement {
	var $melody;

	function __construct() {
		$this->melody=Melody::nw();
	}

	static function nw() {
		return new MelodyToArrangement();
	}

	function melody() {
		return $this->chord;
	}	

	function withMelody($melody) {
		$toArr=clone $this;
		$toArr->melody=$melody;
		return $toArr;
	}

	abstract function toArrangement();
}

?>