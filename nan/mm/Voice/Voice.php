<?php
namespace nan\mm\Voice;
use nan\mm;
use nan\mm\TwelveTone;
use nan\mm\SevenTone;
use nan\mm\PlacedTone;
use nan\mm\ChordedNote;
use nan\mm\Arrangement;
use nan\mm\Part;

class Functions {const Load=1; }

ChordedNote\Functions::Load;
PlacedTone\Functions::Load;
Part\Functions::Load;

class Voice {
	var $chordedNotes=[];
	var $instrument="Acoustic Grand Piano";

	static function nw() {
		return new Voice();
	}

	function instrument() {
		return $this->instrument;
	}

	function withInstrument($instrument) {
		$voice=clone $this;
		$voice->instrument=$instrument;
		return $voice;
	}

	function chordedNotes() 
	{
		return $this->chordedNotes;
	}

	function withChordedNote($chordedNote) {
		$voice=clone $this;
		$voice->chordedNotes[]=$chordedNote;
		return $voice;
	}

	function withNote($note) {
		$chordedNote=ChordedNote\buildChordedNote([$note->placedTone()->tone()],$note->placedTone()->octave(),$note->value())
			->withAttack($note->attack());
		$voice=clone $this;
		$voice->chordedNotes[]=$chordedNote;
		return $voice;
	}

	function __toString() {
		return voiceToCanonical($this);
	}
}

function voiceToCanonical($voice) {
	return sprintf("Voice %s",ChordedNote\chordedNotesToCanonical($voice->chordedNotes() ));
}

function voiceToPart($voice) {
	return Part\Part::nw()->withVoice($voice);
}

function voiceToArrangement($voice) {
	return Arrangement::nw()->withPart(voiceToPart($voice));
}

function sequenceVoices($voices) {
	$chordedNotes=[];
	foreach($voices as $voice) {
		$chordedNotes=array_merge($chordedNotes,$voice->chordedNotes());
	}
	
	$newVoice=Voice::nw();
	foreach($chordedNotes as $chordedNote) {
		$newVoice=$newVoice->withChordedNote($chordedNote);
	}
	return $newVoice;
}

?>