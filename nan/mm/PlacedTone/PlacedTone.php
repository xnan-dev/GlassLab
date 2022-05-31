<?php
namespace nan\mm\PlacedTone;
use nan\mm;
use nan\mm\SevenTone;
use nan\mm\TwelveTone;
use nan\mm\Value;
use nan\mm\Octave;
use nan\mm\Tone;

class Functions { const Load=1; }

Tone\Functions::Load;

class PlacedTone {
	var $tone=TwelveTone\CNatural;
	var $octave=Octave\O4;
	
	static function nw() {
		return  new PlacedTone();
	}

	function tone() {
		return $this->tone;
	}

	function withTone($tone) {
		$note=clone $this;
		$note->tone=$tone;
		return $note;
	}

	function octave() {
		return $this->octave;
	}

	function withOctave($octave) {
		Octave\checkOctave($octave);
		$note=clone $this;
		$note->octave=$octave;
		return $note;
	}

	function __toString() {
		return "".placedToneToCanonical($this);
	}
}

function placedToneToCanonical($placedTone) {
	return sprintf("%s%s",Tone\toneToAmerican($placedTone->tone()),Octave\octaveIndex($placedTone->octave()));
}


function placedTonesToCanonical($placedTones) {
	$s="";
	foreach($placedTones as $placedTone) {
		$s.=" ".placedToneToCanonical($placedTone);
	}
	$s=sprintf("[%s]",$s);
	return $s;
}
?>
