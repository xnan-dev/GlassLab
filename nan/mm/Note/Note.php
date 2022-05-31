<?php
namespace nan\mm\Note;
use nan\mm;
use nan\mm\SevenTone;
use nan\mm\TwelveTone;
use nan\mm\Value;
use nan\mm\Octave;
use nan\mm\Tone;
use nan\mm\PlacedTone;
use nan\mm\ChordedNote;
use nan\mm\Dynamic\Attack;

class Functions { const Load=1; }

ChordedNote\Functions::Load;
PlacedTone\Functions::Load;
Tone\Functions::Load;
Attack\Functions::Load;

class Note {
	var $placedTone;
	var $value=Value\Quarter;
	var $attack=Attack\NotAccented;

	function __construct() {
		$placedTone=PlacedTone\PlacedTone::nw();
	}

	static function nw() {
		return  new Note();
	}

	function placedTone() {
		return $this->placedTone;
	}

	function withPlacedTone($placedTone) {
		$note=clone $this;
		$note->placedTone=$placedTone;
		return $note;
	}

	function value() {
		return $this->value;
	}

	function withValue($value) {
		$note=clone $this;
		$note->value=$value;
		return $note;
	}

	function attack() {
		return $this->attack;
	}

	function withAttack($attack) {
		$note=clone $this;
		$note->attack=$attack;
		return $note;
	}
	function __toString() {
		return "".PlacedTone\placedToneToCanonical($this->placedTone);
	}
}


function buildNote($tone,$octave,$value) {
	return Note::nw()			
		->withPlacedTone(
			PlacedTone\PlacedTone::nw()
				->withTone($tone)
				->withOctave($octave)
		)
		->withValue($value);
}

?>
