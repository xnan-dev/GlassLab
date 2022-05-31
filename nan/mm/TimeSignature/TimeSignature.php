<?php

namespace nan\mm\TimeSignature;
use nan\mm;
use nan\mm\Value;
use nan\mm\Dynamic\Attack;

class Functions { const Load=1; }

Value\Functions::Load;
Attack\Functions::Load;

class TimeSignature {
	var $pulses=4;
	var $pulseValue=Value\Quarter;
	var $pulseAttacks=[];

	static function nw() {
		return new TimeSignature();
	}

	function withPulseAttack($pulseAttack) {
		$ts=clone $this;
		$ts->pulseAttacks[]=$pulseAttack;
		return $ts;
	}

	function pulseAttack($pulse) {
		$count=count($this->pulseAttacks);
		if ($count==0) return Attack\NotAccented;
		return $this->pulseAttacks[$pulse%$count];
	}

	function pulseAttacks() {
		return $pulseAttacks;
	}

	function pulseValue() {
		return $this->pulseValue;
	}

	function withPulseValue($pulseValue) {
		$signature=clone $this;
		$signature->pulseValue=$pulseValue;
		return $signature;
	}

	function pulses() {
		return $this->pulses;
	}

	function withPulses($pulses) {
		$signature=clone $this;
		$signature->pulses=$pulses;
		return $signature;
	}

	function __toString() {
		return timeSignatureToCanonical(this);
	}
}

function timeSignatureToCanonical($timeSignature) {	
	return sprintf("TimeSignature %s/V%s",
		$timeSignature->pulses(),
		Value\valueToCanonical($timeSignature->pulseValue())
		);
}

function timeSignChordedNote($timeSignature,$chordedNote,$pulse) {
	$attack=$timeSignature->pulseAttack($pulse);	
	$timeSigned=$chordedNote;
	if ($attack!=Attack\NotAccented) {
		$timeSigned=$chordedNote->withAttack($attack);
	}
	return $timeSigned;
}

?>