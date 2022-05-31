<?php
namespace nan\mm\Chord;
use nan\mm;
use nan\mm\Tone;
use nan\mm\TwelveTone;
use nan\mm\Interval;

class Functions { const Load=1; }

Tone\Functions::Load;
TwelveTone\Functions::Load;
Interval\Functions::Load;

class Chord {
	var $intervals=[];
	var $root=TwelveTone\CNatural;

	static function nw() {
		return new Chord();
	}

	function intervals() {
		return $this->intervals;
	}

	function withInterval($interval) {
		$chord=clone $this;
		$chord->intervals[]=$interval;
		return $chord;
	}

	function bassTone() {
		return TwelveTone\twelveAddInterval($this->root,$this->intervals[0]);
	}

	function nonBassTones() {
		$tones=[];
		for($i=1;$i<count($this->intervals);$i++) {
			$interval=$this->intervals[$i];
			$tone=TwelveTone\twelveAddInterval($this->root,$interval);
			$tones[]=$tone;
		}
		return $tones;
	}	

	function root() {
		return $this->root;
	}

	function withRoot($root) {
		$chord=clone $this;
		$chord->root=$root;
		return $chord;
	}

	function __toString() {
		return sprintf("Chord: %s",chordToAmerican($this));
	}
}


function chordTones($chord) {
	$tones=[];
	for($i=0;$i<count($chord->intervals());$i++) {
		$interval=$chord->intervals()[$i];
		$tone=TwelveTone\twelveAddInterval($chord->root(),$interval);
		$tones[]=$tone;
	}
	return $tones;
}

function chordMajor($root) {
	return Chord::nw()
		->withRoot($root)
		->withInterval(Interval\Unison)
		->withInterval(Interval\MajorThird)
		->withInterval(Interval\PerfectFifth);
}

function chordMajorName($root) {
	return Tone\toneToAmerican($root);
}


function chordMinor($root) {
	return Chord::nw()
		->withRoot($root)
		->withInterval(Interval\Unison)
		->withInterval(Interval\MinorThird)
		->withInterval(Interval\PerfectFifth);
}

function chordSus4($root) {
	return Chord::nw()
		->withRoot($root)
		->withInterval(Interval\Unison)
		->withInterval(Interval\PerfectFourth)
		->withInterval(Interval\PerfectFifth);
}

function chordDiminished($root) {
	return Chord::nw()
		->withRoot($root)
		->withInterval(Interval\Unison)
		->withInterval(Interval\MinorThird)
		->withInterval(Interval\DiminishedFifth);
}

function chordToMaj7($chord) {
	return $chord->withInterval(Interval\MajorSeventh);
}

function chordTo7($chord) {
	return $chord->withInterval(Interval\MinorSeventh);
}

function chordToDim7($chord) {
	return $chord->withInterval(Interval\DiminishedSeventh);
}

function chordMinorName($root) {
	return sprintf("%sm",Tone\toneToAmerican($root));
}

function buildAmericanToChord() {
	$americanToChord=array();
	foreach(TwelveTone\TwelveToneSet as $tone) {
		$americanToChord[chordMajorName($tone)]=chordMajor($tone);
		$americanToChord[chordMinorName($tone)]=chordMinor($tone);

		$americanToChord[chordMajorName($tone)."sus4"]=chordSus4($tone);
		$americanToChord[chordMajorName($tone)."dim"]=chordDiminished($tone);
		$americanToChord[chordMajorName($tone)."dim7"]=chordToDim7(chordDiminished($tone));
		
		$americanToChord[chordMajorName($tone)."maj7"]=chordToMaj7(chordMajor($tone));
		$americanToChord[chordMinorName($tone)."maj7"]=chordToMaj7(chordMinor($tone));
		$americanToChord[chordMajorName($tone)."7"]=chordTo7(chordMajor($tone));
		$americanToChord[chordMinorName($tone)."7"]=chordTo7(chordMinor($tone));
	}
	return $americanToChord;
}

function chordToAmerican($chord) {
	$americanToChord=buildAmericanToChord();
	foreach($americanToChord as $american=>$chord2) {
		if ($chord==$chord2) return $american;
	}
	throw \Exception("chordToAmerican: unrecognized chord");
}

function americanToChord($american) {
	$americanToChord=buildAmericanToChord();
	return $americanToChord[$american];
}

function selectChordTones($chord,$tones) {
	$sel=[];
	$toneCount=count(chordTones($chord));
	foreach($tones as $tone) {
		$selTone=chordTones($chord)[$tone%$toneCount];
		$sel[]=$selTone;
	}
	return $sel;
}
?>