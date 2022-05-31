<?php
namespace nan\mm\Melody;
use nan\mm;
use nan\mm\TwelveTone;
use nan\mm\SevenTone;
use nan\mm\Note;
use nan\mm\PlacedTone;
use nan\mm\Octave;
use nan\mm\Value;
use nan\mm\Voice;
use nan\mm\ChordedNote;

class Functions { const Load=1; }

Value\Functions::Load;
Voice\Functions::Load;
ChordedNote\Functions::Load;
Note\Functions::Load;

class Melody {
	var $notes=[];

	static function nw() {
		return new Melody();
	}

	function notes() {
		return $this->notes;
	}

	

	function withNote($note) {
		$melody=clone $this;

		$melody->notes[]=$note;
		return $melody;
	}

	function __toString() {
		return sprintf("Melody %s",$this->notesToString());
	}

	function notesToString() {
		foreach ($this->notes as $note) {
			$noteStr=$note->__toString($note);
			$notesStr.=sprintf("%s ",$noteStr);
		}
		return $notesStr;
	}
}

function americanToNote($american) {
		$tone=TwelveTone\americanToTwelve($american);
		$canonicalValue=substr($americanCommand,strlen($americanCommand)-1,1);
		$value=Value\canonicalToValue($canonicalValue);

		$note=Note\buildNote($tone,$octave,$value);			
		return $note;
}

function americanToMelody($american) {
	$americanCommands=explode(" ",$american);
	$melody=Melody::nw();
	$octave=Octave\O4;
	foreach ($americanCommands as $americanCommand) {
		if (Octave\isCanonical($americanCommand)) {
			$octave=Octave\canonicalToOctave($americanCommand);
		} else {
			$canonicalTone=substr($americanCommand,0,strlen($americanCommand)-1);
			$note=americanToNote($canonicalTone);
			$melody=$melody->withNote($note);

		}
	}
	return $melody;
}

function melodyToVoice($melody) {
	$voice=Voice\Voice::nw();
	foreach($melody->notes() as $note) {
		$voice=$voice->withChordedNote(ChordedNote\noteToChordedNote($note));
	}
	return $voice;
}
?>