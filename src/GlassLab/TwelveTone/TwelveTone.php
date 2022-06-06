<?php
namespace xnan\Trurl\GlassLab\TwelveTone;
use xnan\Trurl\GlassLab\SevenTone;
use xnan\Trurl\GlassLab\Interval;

SevenTone\Functions::Load;
Interval\Functions::Load;

class Functions { const Load=1; }

const ANatural=20001;
const ASharp=20002;
const ASharpSharp=20003;
const AFlat=20004;
const AFlatFlat=20005;
const BNatural=20006;
const BSharp=20007;
const BSharpSharp=20008;
const BFlat=20009;
const BFlatFlat=20010;
const CNatural=20011;
const CSharp=20012;
const CSharpSharp=20013;
const CFlat=20014;
const CFlatFlat=20015;
const DNatural=20016;
const DSharp=20017;
const DSharpSharp=20018;
const DFlat=20019;
const DFlatFlat=20020;
const ENatural=20021;
const ESharp=20022;
const ESharpSharp=20023;
const EFlat=20024;
const EFlatFlat=20025;
const FNatural=20026;
const FSharp=20027;
const FSharpSharp=20027;
const FFlat=20028;
const FFlatFlat=20029;
const GNatural=20030;
const GSharp=20031;
const GSharpSharp=20032;
const GFlat=20033;	
const GFlatFlat=20034;	
const Rest=20035;

const TwelveSharps=array(ASharp,BSharp,CSharp,DSharp,ESharp,FSharp,GSharp);
const TwelveFlats=array(AFlat,BFlat,CFlat,DFlat,EFlat,FFlat,GFlat,AFlat);
const TwelveNaturals=array(ANatural,BNatural,CNatural,DNatural,ENatural,FNatural,GNatural);
const TwelveToneSet=array(ASharp,BSharp,CSharp,DSharp,ESharp,FSharp,GSharp,AFlat,BFlat,CFlat,DFlat,EFlat,FFlat,GFlat,AFlat,ANatural,BNatural,CNatural,DNatural,ENatural,FNatural,GNatural,Rest);

const TwelveToAmerican=array(
	ANatural=>"A",
	ASharp=>"A#",
	AFlat=>"Ab",
	BNatural=>"B",
	BSharp=>"B#",
	BFlat=>"Bb",
	CNatural=>"C",
	CSharp=>"C#",
	CFlat=>"Cb",
	DNatural=>"D",
	DSharp=>"D#",
	DFlat=>"Db",
	ENatural=>"E",
	ESharp=>"E#",
	EFlat=>"Eb",
	FNatural=>"F",
	FSharp=>"F#",
	FFlat=>"Fb",
	GNatural=>"G",
	GSharp=>"G#",
	GFlat=>"Gb",
	Rest=>"r",
);

const TwelveToFlat=array(
	ANatural=>AFlat,
	ASharp=>ANatural,
	AFlat=>AFlatFlat,
	BNatural=>BFlat,
	BSharp=>BNatural,
	BFlat=>BFlatFlat,
	CNatural=>CFlat,
	CSharp=>CSharpSharp,
	CFlat=>CNatural,
	DNatural=>DFlat,
	DSharp=>DNatural,
	DFlat=>DFlatFlat,
	ENatural=>EFlat,
	ESharp=>ENatural,
	EFlat=>EFlatFlat,
	FNatural=>FFlat,
	FSharp=>FNatural,
	FFlat=>FFlatFlat,
	GNatural=>GFlat,
	GSharp=>GNatural,
	GFlat=>GFlatFlat,
	Rest=>Rest,
);

const TwelveToSharp=array(
	ANatural=>ASharp,
	ASharp=>ASharpSharp,
	AFlat=>ANatural,
	BNatural=>BSharp,
	BSharp=>BSharpSharp,
	BFlat=>BNatural,
	CNatural=>CSharp,
	CSharp=>CSharpSharp,
	CFlat=>CNatural,
	DNatural=>DSharp,
	DSharp=>DSharpSharp,
	DFlat=>DNatural,
	ENatural=>ESharp,
	ESharp=>ESharpSharp,
	EFlat=>ENatural,
	FNatural=>FSharp,
	FSharp=>FSharpSharp,
	FFlat=>FNatural,
	GNatural=>GSharp,
	GSharp=>GSharpSharp,
	GFlat=>GNatural,
	Rest=>Rest,
);
const TwelveTonePitch=array(
	BSharp=>0,
	CNatural=>0,
	CSharp=>1,
	DFlat=>1,
	DNatural=>2,
	DSharp=>3,
	EFlat=>3,
	ENatural=>4,
	FFlat=>4,
	ESharp=>5,
	FNatural=>5,
	FSharp=>6,
	GFlat=>6,
	GNatural=>7,
	GSharp=>8,
	AFlat=>8,
	ANatural=>9,
	ASharp=>10,
	BFlat=>11,
	BNatural=>11,
	CFlat=>11
);

const TwelveToTonal=array(
	ANatural=>SevenTone\A,
	ASharp=>SevenTone\A,
	AFlat=>SevenTone\A,
	BNatural=>SevenTone\B,
	BSharp=>SevenTone\B,
	BFlat=>SevenTone\B,
	CNatural=>SevenTone\C,
	CSharp=>SevenTone\C,
	CFlat=>SevenTone\C,
	DNatural=>SevenTone\D,
	DSharp=>SevenTone\D,
	DFlat=>SevenTone\D,
	ENatural=>SevenTone\E,
	ESharp=>SevenTone\E,
	EFlat=>SevenTone\E,
	FNatural=>SevenTone\F,
	FSharp=>SevenTone\F,
	FFlat=>SevenTone\F,
	GNatural=>SevenTone\G,
	GSharp=>SevenTone\G,
	GFlat=>SevenTone\G,
	Rest=>SevenTone\Rest
);

const SevenToTwelve=array(
	SevenTone\A=>ANatural,
	SevenTone\B=>BNatural,
	SevenTone\C=>CNatural,
	SevenTone\D=>DNatural,
	SevenTone\E=>ENatural,
	SevenTone\F=>FNatural,
	SevenTone\G=>GNatural,
	SevenTone\Rest=>Rest
);

function checkTwelveTone($tone) {
	$in=in_array($tone,TwelveToneSet,true);	
	if (!$in) {
		print "checkTwelveTone: FAIL tone: $tone\n";
		throw new \Exception("checkTwelveTone: FAIL tone: $tone");
	}
}

function isFlat($tone) 
{
	checkTwelveTone($tone);
	return in_array($tone,TwelveFlats,true);
}

function isRest($tone) 
{
	checkTwelveTone($tone);
	return $tone==Rest;
}

function isSharp($tone) 
{
	checkTwelveTone($tone);
	return in_array($tone,TwelveSharps,true);
}

function isNatural($tone)
{
	checkTwelveTone($tone);
	return in_array($tone,TwelveNaturals,true);
}

function isTwelveTone($tone) {
	return in_array($tone,TwelveToneSet);
}

function twelveToSeven($tone)
{
	checkTwelveTone($tone);
	return TwelveToTonal[$tone];
}

function sevenToTwelve($tone)
{
	SevenTone\checkSevenTone($tone);
	return SevenToTwelve[$tone];
}

function twelveToAmerican($tone) {
	checkTwelveTone($tone);
	return TwelveToAmerican[$tone];
}

function americanToTwelve($american) {	
	$americanToTwelve=array_flip(TwelveToAmerican);
	if (!array_key_exists($american,$americanToTwelve)) throw new \Exception("americanToTwelve: american:'$american' msg: unknown tone");
	return $americanToTwelve[$american];	
}

function twelveTonePitch($tone) {
	checkTwelveTone($tone);
	return TwelveTonePitch[$tone];
}

function twelveAddInterval($twelveTone,$interval) {
	$intervalSemitones=Interval\intervalSemitones($interval);
	$sevenTone=twelveToSeven($twelveTone);
	$toneDistance=Interval\IntervalToneDistance[$interval];
	$sevenToneIndex=SevenTone\ToneToIndex[$sevenTone];
	$newSevenTone=SevenTone\IndexToTone[($sevenToneIndex+$toneDistance)%7];	
	$newTwelveTone=sevenToTwelve($newSevenTone);
	$newDistance=Interval\semitonesBetweenTwelve($newTwelveTone,$twelveTone);
	
	
	if ($interval==Interval\Unison) {
		$newTwelveTone=$twelveTone;
		$newDistance=0;
	} else {
		while ($intervalSemitones>$newDistance) {
			$newTwelveTone=sharpTwelve($newTwelveTone);
			$newDistance=($newDistance+1)%12;
		}
		while ($intervalSemitones<$newDistance) {
			$newTwelveTone=flatTwelve($newTwelveTone);
			$newDistance=($newDistance-1)%12;
		}		
	}
	
	//print sprintf("dg-addInterval twelveTone:%s newSevenTone:%s newTwelveTone:%s toneDistance:$toneDistance  interval:%s intervalSemitones:$intervalSemitones currentSemitones:$newDistance\n",twelveToAmerican($twelveTone),SevenTone\sevenToneToAmerican($newSevenTone),twelveToAmerican($newTwelveTone),Interval\intervalToCanonical($interval));
	return $newTwelveTone;
}

function flatTwelve($twelveTone) {
	return TwelveToFlat[$twelveTone];
}

function sharpTwelve($twelveTone) {
	return TwelveToSharp[$twelveTone];	
}

?>