<?php
namespace nan\mm\Interval;
use nan\mm;
use nan\mm\TwelveTone;
use nan\mm\SevenTone;

TwelveTone\Functions::Load;
SevenTone\Functions::Load;

class Functions { const Load=1; }

const Unison=50000;
const MinorSecond=50001;
const MajorSecond=50002;
const MinorThird=50003;
const MajorThird=50004;
const PerfectFourth=50005;
const PerfectFifth=50006;
const AugmentedFourth=50007;
const MinorSixth=50008;
const MajorSixth=50009;
const MinorSeventh=50010;
const MajorSeventh=50011;
const PerfectOctave=50012;

const DiminishedThird=50101;
const DiminishedFourth=50102;
const DiminishedFifth=50103;
const DiminishedSixth=50104;
const DiminishedSeventh=50105;

const AugmentedSecond=50206;
const AugmentedThird=50207;
const AugmentedFourth=50208;
const AugmentedFifth=50209;
const AugmentedSixth=50210;

const IntervalSemitones=array(
	Unison=>0,
	MinorSecond=>1,
	MajorSecond=>2,
	MinorThird=>3,
	MajorThird=>4,
	PerfectFourth=>5,
	PerfectFifth=>7,
	MinorSixth=>8,
	MajorSixth=>9,
	MinorSeventh=>10,
	MajorSeventh=>11,
	PerfectOctave=>12,

	DiminishedThird=>2,
	DiminishedFourth=>4,
	DiminishedFifth=>6,
	DiminishedSixth=>7,
	DiminishedSeventh=>9,

	AugmentedSecond=>3,
	AugmentedThird=>5,
	AugmentedFourth=>6,
	AugmentedFifth=>8,
	AugmentedSixth=>10
);

const IntervalToneDistance=array(
	Unison=>0,
	MinorSecond=>1,
	MajorSecond=>1,
	MinorThird=>2,
	MajorThird=>2,
	PerfectFourth=>3,	
	PerfectFifth=>4,
	MinorSixth=>5,
	MajorSixth=>5,
	MinorSeventh=>6,
	MajorSeventh=>6,
	PerfectOctave=>7,

	DiminishedThird=>2,
	DiminishedFourth=>3,
	DiminishedFifth=>4,
	DiminishedSixth=>5,
	DiminishedSeventh=>6,

	AugmentedSecond=>1,
	AugmentedThird=>2,
	AugmentedFourth=>3,
	AugmentedFifth=>4,
	AugmentedSixth=>5
);

const IntervalToCanonical=array(
	Unison=>"Unison",
	MinorSecond=>"MinorSecond",
	MajorSecond=>"MajorSecond",
	MinorThird=>"MinorThird",
	MajorThird=>"MajorThird",
	PerfectFourth=>"PerfectFourth",
	PerfectFifth=>"PerfectFifth",
	AugmentedFourth=>"AugmentedFourth",
	MinorSixth=>"MinorSixth",
	MajorSixth=>"MajorSixth",
	MinorSeventh=>"MinorSeventh",
	MajorSeventh=>"MajorSeventh",
	PerfectOctave=>"PerfectOctave"
);

function intervalToCanonical($interval) {
	return IntervalToCanonical[$interval];
}

function intervalSemitones($interval) {
	return IntervalSemitones[$interval];
}

function semitonesBetweenTwelve($twelveTone1,$twelveTone2) {
	$pitch1=TwelveTone\TwelveTonePitch[$twelveTone2];
	$pitch2=TwelveTone\TwelveTonePitch[$twelveTone1];
	//print "dg-pitch1: $pitch1 pitch2:$pitch2\n";
	$interval=($pitch2-$pitch1)%12;
	if ($interval<0) $interval=$interval+12;
	return $interval;
}

?>