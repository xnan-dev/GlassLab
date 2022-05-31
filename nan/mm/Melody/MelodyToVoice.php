<?php
namespace nan\mm\Melody;
use nan\mm;
use nan\mm\Voice;

Functions::Load;

abstract class  MelodyToVoice {
	var $melody;

	function __construct() {
		$this->melody=Melody::nw();
	}

	static function nw() {
		return new MelodyToVoice();
	}

	function melody() {
		return $this->chord;
	}	

	function withMelody($melody) {
		$toVoice=clone $this;
		$toVoice->melody=$melody;
		return $toVoice;
	}

	abstract function toVoice();
}

?>