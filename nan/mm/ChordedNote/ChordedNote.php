<?php
namespace nan\mm\ChordedNote;
use nan\mm\SevenTone;
use nan\mm\TwelveTone;
use nan\mm\Value;
use nan\mm\Octave;
use nan\mm\PlacedTone;
use nan\mm\Dynamic\Attack;

class Functions { const Load=1; }

PlacedTone\Functions::Load;
Attack\Functions::Load;

class ChordedNote {
	var $placedTones=[];
	var $value=Value\Quarter;
	var $attack=Attack\NotAccented;

	static function nw() {
		return  new ChordedNote();
	}

	function placedTones() {
		return $this->placedTones;
	}

	function withPlacedTone($placedTone) {
		$chordedNote=clone $this;
		$chordedNote->placedTones[]=$placedTone;
		return $chordedNote;
	}
	function __toString() {
		return chordedNoteToCanonical($this);
	}

	function attack() {
		return $this->attack;
	}

	function withAttack($attack) {
		$note=clone $this;
		$note->attack=$attack;
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
}

function chordedNoteToCanonical($chordedNote) {	
	return sprintf("%s V%s A%s",
		PlacedTone\placedTonesToCanonical($chordedNote->placedTones()),
		Value\valueToCanonical($chordedNote->value()),$chordedNote->attack());
}

function chordedNotesToCanonical($chordedNotes) {

	$chordedNotesStr="";
	foreach ($chordedNotes as $chordedNote) {		

		$chordedNoteStr=chordedNoteToCanonical($chordedNote);
		$chordedNotesStr.=sprintf("%s ",$chordedNoteStr);
	}
	$chordedNotesStr=sprintf("[%s]",$chordedNotesStr);
	return $chordedNotesStr;
}

function noteToChordedNote($note) {
	return ChordedNote::nw()
		->withPlacedTone($note->placedTone())
		->withValue($note->value())
		->withAttack($note->attack());	
}


function buildChordedNote($tones,$octave,$value) {
	if (!is_array($tones)) throw new \exception("buildChordedNote: tones: should be an array");
	$chordedNote=ChordedNote::nw()->withValue($value);

	foreach($tones as $tone) {
		$chordedNote=$chordedNote->withPlacedTone(
				PlacedTone\PlacedTone::nw()
					->withTone($tone)
					->withOctave($octave)
		);
	}
	return $chordedNote;
}

?>
