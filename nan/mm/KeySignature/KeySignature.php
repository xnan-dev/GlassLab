<?php

namespace nan\mm\KeySignature;
use nan\mm;
use nan\mm\KeySignature;
use nan\mm\TwelveTone;

TwelveTone\Functions::Load;

class Functions { const Load=1; }

class KeySignature {
	var $tones=array();
	
	static function nw() {
		return new KeySignature();
	}

	function tones() {
		return $this->tones;
	}

	function withTones($tones) {
		$ks=clone $this;
		$ks->tones=$tones;
		return $ks;		
	}

	function withTone($tone) {
		$ks=clone $this;
		$ks->tones[]=$tone;
		return $ks;
	}
}

function keyC() {
	return KeySignature::nw()->withTones([TwelveTone\CNatural,TwelveTone\DNatural,TwelveTone\ENatural,TwelveTone\FNatural,TwelveTone\GNatural,TwelveTone\ANatural,TwelveTone\BNatural]);
}

function keyG() {
	return KeySignature::nw()->withTones([TwelveTone\CNatural,TwelveTone\DNatural,TwelveTone\ENatural,TwelveTone\FSharp,TwelveTone\GNatural,TwelveTone\ANatural,TwelveTone\BNatural]);
}

function inKey($keySignature,$tone) {
	foreach($keySignature->tones() as $keyTone) {
		if ($keyTone==$tone) return true;
	}
	return false;
}

?>