<?php
namespace nan\mm\Chord;
use nan\mm;
use nan\mm\Voice;

Functions::Load;

abstract class  ChordToVoice {
	var $chord;

	function __construct() {
		$this->chord=americanToChord("C");
	}

	static function nw() {
		return new ChordToVoice;
	}

	function chord() {
		return $this->chord;
	}	

	function withChord($chord) {
		$toVoice=clone $this;
		$toVoice->chord=$chord;
		return $toVoice;
	}

	abstract function toVoice();
}

?>