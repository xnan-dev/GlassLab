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

class ChordToWaltz extends ChordToVoice {
	static function nw() {
		return new ChordToWaltz();
	}

	function toVoice() {		
		return Voice\Voice::nw()
			->withNote(Note\buildNote($this->chord()->bassTone(),Octave\O4,Value\Quarter)
				->withAttack(Attack\Accented))
			->withChordedNote(ChordedNote\buildChordedNote($this->chord()->nonBassTones(),Octave\O4,Value\Quarter))
			->withChordedNote(ChordedNote\buildChordedNote($this->chord()->nonBassTones(),Octave\O4,Value\Quarter));
	}
}
?>