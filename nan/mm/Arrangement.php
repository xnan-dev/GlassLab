<?php
namespace nan\mm;
use nan\mm\Tempo;
use nan\mm\TimeSignature;

class Arrangement {
	var $parts=[];

	static function nw() {
		$arrangement= new Arrangement();
		return $arrangement;
	}

	function parts() {
		return $this->parts;
	}

	function withPart($part) {
		$arrangement=clone $this;
		$arrangement->parts[]=$part;
		return $arrangement;
	}
	
	function __toString() {
		return arrangementToCanonical($this);
	}	
}

function arrangementToCanonical($arrangement) {	
	$s="Arrangement";
	foreach($arrangement->parts() as $part) {
		$s.=" part:$part";
	}
	return $s;
}

?>