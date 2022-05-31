<?php
namespace nan\mm\ChordProgression;
use nan\mm;
use nan\mm\Voice;
use nan\mm\Chord;

Voice\Functions::Load;

class  ChordProgressionToVoice {
	var $chordProgression;
	var $chordToVoice;

	function __construct() {
		$this->chordProgression=ChordProgression::nw();
		$this->chordToVoice=Chord\ChordToWaltz::nw();
	}

	static function nw() {
		return new ChordProgressionToVoice();
	}

	function chordProgression() {
		return $this->chordProgression;
	}	

	function withChordProgression($chordProgression) {
		 $toVoice=clone $this;
		 $toVoice->chordProgression=$chordProgression;
		 return $toVoice;
	}	

	function chordToVoice() {
		return $this->chordToVoice;
	}

	function withChordToVoice($chordToVoice) {
		 $toVoice=clone $this;
		 $toVoice->chordToVoice=$chordToVoice;
		 return $toVoice;
	}

	function toVoice() {
		$voices=[];
		foreach($this->chordProgression->chords() as $chord) {
			$voices[]=$this->chordToVoice->withChord($chord)->toVoice();			
		}
		return Voice\sequenceVoices($voices);
	}
}

?>