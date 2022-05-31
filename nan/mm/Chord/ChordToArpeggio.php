<?php

namespace nan\mm\Chord;
use nan\mm;
use nan\mm\Voice;
use nan\mm\Octave;
use nan\mm\Value;
use nan\mm\Note;
use nan\mm\ChordedNote;
use nan\mm\Dynamic\Attack;

Note\Functions::Load;
Voice\Functions::Load;
ChordedNote\Functions::Load;
Octave\Functions::Load;
Attack\Functions::Load;

class ChordToArpeggio extends ChordToVoice {
	var $arpeggioTonesList=array();

	static function nw() {
		return new ChordToArpeggio();
	}

	function withArpeggioTones($arpeggioTones) {
		$arp=clone $this;
		$arp->arpeggioTonesList[]=$arpeggioTones;
		return $arp;
	}

	function toVoice() {		
		 $voice=Voice\Voice::nw();
		 foreach($this->arpeggioTonesList as $arpeggioTones) {
		 	$selectedTones=selectChordTones($this->chord(),$arpeggioTones);
		 	$voice=$voice->withChordedNote(
		 			ChordedNote\buildChordedNote($selectedTones,Octave\O4,Value\Quarter)
		 		);
		 }	
		 return $voice;		
	}
}
?>