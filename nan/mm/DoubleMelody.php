<?php
namespace nan\mm;
use nan\mm\TwelveTone;
use nan\mm\Melody;
use nan\mm\Part;

require_once("autoloader.php");

class DoubleMelody extends Melody\MelodyToPart {
	var $octave;

	static function nw() {
		return new DoubleMelody();
	}

	function otave() {
		return $this->octave;
	}

	function withOctave($octave) {
		$double=clone $this;
		$double->octave=$octave;
		return $double;
	}

	function toPart() {
		$part=Part\Part::nw();

		$originalVoice=Voice\Voice::nw();
		$doubleVoice=Voice\Voice::nw();
		foreach($this->melody->notes() as $note) {
			$originalVoice=$originalVoice->withNote($note);
			$doubleNote=$note->withPlacedTone($note->placedTone()->withOctave($this->octave));
			$doubleVoice=$doubleVoice->withNote($doubleNote);
		}
				
		$part=$part
			->withVoice($originalVoice)
			->withVoice($doubleVoice);

		return $part;
	}
}

?>