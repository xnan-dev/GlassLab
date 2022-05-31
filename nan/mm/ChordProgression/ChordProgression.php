<?php
namespace nan\mm\ChordProgression;
use nan\mm\Chord;

Chord\Functions::Load;

class Functions { const Load=1; }

class ChordProgression {
	var $chords=[];

	static function nw() {
		return new ChordProgression();
	}

	function chords() 
	{
		return $this->chords;
	}

	function withChord($chord) {
		$chordProgression=clone $this;
		$chordProgression->chords[]=$chord;
		return $chordProgression;
	}

	function __toString() {
		return sprintf("ChordProgression %s",$this->chordsToString());
	}

	function chordsToString() {
		$chordsStr="";
		foreach ($this->chords as $chord) {
			$chordStr=Chord\chordToAmerican($chord);
			$chordsStr.=sprintf("%s ",$chordStr);
		}
		return $chordsStr;
	}
}

function americanToChordProgression($american) {
	$americanCommands=explode(" ",$american);
	$chordProgression=ChordProgression::nw();
	
	foreach ($americanCommands as $americanCommand) {
			$americanChord=$americanCommand;
			$chord=Chord\americanToChord($americanChord);
			$chordProgression=$chordProgression->withChord($chord);		
	}
	return $chordProgression;
}
?>