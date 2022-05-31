<?php
namespace nan\mm\Octave;
use nan\mm;

class Functions { const Load=1; }

const O0=40000;
const O1=40001;
const O2=40002;
const O3=40003;
const O4=40004;
const O5=40005;
const O6=40006;
const O7=40007;
const O8=40008;

const OctaveSet = array(O0,O1,O2,O3,O4,O5,O6,O7,O8);

const OctaveToCanonical=array(
	O0=>"O0",
	O1=>"O1",
	O2=>"O2",
	O3=>"O3",
	O4=>"O4",
	O5=>"O5",
	O6=>"O6",
	O7=>"O7",
	O8=>"O8"
);

const CanonicalToOctave=array(
	"O0"=>O0,
	"O1"=>O1,
	"O2"=>O2,
	"O3"=>O3,
	"O4"=>O4,
	"O5"=>O5,
	"O6"=>O6,
	"O7"=>O7,
	"O8"=>O8
);

function checkOctave($octave) {
	if(!in_array($octave,OctaveSet,true)) {
		throw new \Exception("checkOctave status:FAIL octave:$octave msg: unrecognized octave");
	}
}

function octaveIndex($octave) {
	checkOctave($octave);
	return $octave-40000;
}

function isCanonical($canonical) {
	return in_array($canonical,array_keys(CanonicalToOctave),true);
}

function canonicalToOctave($canonical) {
	return CanonicalToOctave[$canonical];
}

?>