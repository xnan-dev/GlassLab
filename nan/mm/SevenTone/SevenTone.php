<?php
namespace nan\mm\SevenTone;
use nan\mm;
class Functions { const Load=1; }

const A=10001;
const B=10002;
const C=10003;
const D=10004;
const E=10005;
const F=10006;
const G=10007;
const Rest=10008;

const SevenToneSet=array(A,B,C,D,E,F,G,Rest);


const SevenTonePitch=array(
	C=>0,
	D=>2,
	E=>4,
	F=>5,
	G=>7,
	A=>9,
	B=>11
);

const ToneToIndex=array(
	A=>0,
	B=>1,
	C=>2,
	D=>3,
	E=>4,
	F=>5,
	G=>6
);

const IndexToTone=array(
	0=>A,
	1=>B,
	2=>C,
	3=>D,
	4=>E,
	5=>F,
	6=>G
);


const SevenToneToAmerican=array(
	A=>"A",
	B=>"B",
	C=>"C",
	D=>"D",
	E=>"E",
	F=>"F",
	G=>"G",
	Rest=>"r"
);

const AmericanToSevenTone=array(
	"A"=>A,
	"B"=>B,
	"C"=>C,
	"D"=>D,
	"E"=>E,
	"F"=>F,
	"G"=>G,
	"r"=>Rest
);

function isSevenTone($tone) {
	return in_array($tone,SevenToneSet);
}

function checkSevenTone($tone) {
	$in=in_array($tone,SevenToneSet,true);	
	if (!$in) {
		print "checkSevenTone: FAIL tone: $tone\n";
		throw new \Exception("checkSevenTone: FAIL tone: $tone");
	}
}

function sevenToneToAmerican($tone) {
	checkSevenTone($tone);
	return SevenToneToAmerican[$tone];
}

function americanToSevenTone($american) {
	return AmericanToSevenTone[$american];	
}

function sevenTonePitch($tone) {
	checkSevenTone($tone);
	return SevenTonePitch[$tone];
}

function isRest($tone) {
	checkSevenTone($tone);
	return $tone==Rest;	
}
?>