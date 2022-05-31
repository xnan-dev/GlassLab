<?php
namespace nan\mm\reduce;
use nan\mm;
use nan\mm\node;

class ChordReducer extends NodeReducer {
	function reduceChord($m,$c) {
		$chordNotes=$m->notes();
		$chordMerged=node\list_to_merge($chordNotes);		
		return $chordMerged;
	}
}

?>