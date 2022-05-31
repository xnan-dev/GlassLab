<?php
namespace nan\mm\Part;
use nan\mm\Tempo;
use nan\mm\TimeSignature;

class Functions { const Load=1; }

class Part {
	var $voices=[];
	var $tempo;
	var $timeSignature;

	static function nw() {
		$part= new Part();
		$tempo=Tempo\Tempo::nw();
		$part->tempo=$tempo;
		$part->timeSignature=TimeSignature\TimeSignature::nw();

		return $part;
	}

	function voices() {
		return $this->voices;
	}

	function withVoice($voice) {
		$part=clone $this;
		$part->voices[]=$voice;
		return $part;
	}
	
	function tempo() {
		return $this->tempo;
	}

	function withTempo($tempo) {
		$part=clone $this;
		$part->tempo=$tempo;
		return $part;
	}

	function timeSignature() {
		return $this->timeSignature;
	}

	function withTimeSignature($timeSignature) {
		$part=clone $this;
		$part->timeSignature=$timeSignature;
		return $part;
	}

	function __toString() {
		return partToCanonical($this);
	}	
}

function partToCanonical($part) {	
	$s="Part";
	foreach($part->voices() as $voice) {
		$s.=" voice:$voice";
	}
	return $s;
}

?>