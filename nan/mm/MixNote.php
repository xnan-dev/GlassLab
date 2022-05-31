<?php
namespace nan\mm;
use nan\mm\TwelveTone;
use nan\mm\PlacedTone;
use nan\mm\Note;

require_once("autoloader.php");

class MixNote extends MelodyModifier {
	var $placedTone;
	
	function __construct() {
		$this->placedTone=PlacedTone\PlacedTone::nw();
	}

	static function nw() {
		return new MixNote();
	}

	function tone() {
		return $this->tone;
	}

	function withTone($tone) {
		$mixNote=clone $this;
		$mixNote->tone=$tone;
		return $mixNote;
	}

	function modify($melody) {
		$retMelody=Melody::nw();
		foreach($melody->notes() as $note) {
			$retMelody=$retMelody->withNote($note);
			$retMelody=$retMelody->withNote(
				Note\Note::nw()->withPlacedTone($this->placedTone)
			);
		}
		return $retMelody;
	}
}

?>