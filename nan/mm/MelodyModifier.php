<?php
namespace nan\mm;
use nan\mm\TwelveTone;
use nan\mm\Note;

require_once("autoloader.php");

abstract class MelodyModifier {
	var $melody;

	function melody() {
		return $this->melody;
	}

	function withMelody($melody) {
		$modifier=clone $this;
		$modifier->melody=$melody;
		return $modifier;
	}

	 abstract function toMelody();	
}


?>