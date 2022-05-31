<?php
namespace nan\mm\Value;
use nan\mm;

class Functions { const Load=1; }

const Large=30001;
const Long=30002;
const DoubleWhole=30003;
const Whole=30004;
const Half=30005;
const Quarter=30006;
const Slash8=30007;
const Slash16=30008;
const Slash32=30009;
const Slash64=30010;
const Slash128=30011;
const Slash256=30012;
const DottedLarge=30101;
const DottedLong=30102;
const DottedDoubleWhole=30103;
const DottedWhole=30104;
const DottedHalf=30105;
const DottedQuarter=30106;
const DottedSlash8=30107;
const DottedSlash16=30108;
const DottedSlash32=30109;
const DottedSlash64=30110;
const DottedSlash128=30111;
const DottedSlash256=30112;
const DoubleDottedLarge=30301;
const DoubleDottedLong=30302;
const DoubleDottedDoubleWhole=30303;
const DoubleDottedWhole=30304;
const DoubleDottedHalf=30305;
const DoubleDottedQuarter=30306;
const DoubleDottedSlash8=30307;
const DoubleDottedSlash16=30308;
const DoubleDottedSlash32=30309;
const DoubleDottedSlash64=30309;
const DoubleDottedSlash128=30309;
const DoubleDottedSlash256=30310;
const TripleDottedLarge=30301;
const TripleDottedLong=30302;
const TripleDottedDoubleWhole=30303;
const TripleDottedWhole=30304;
const TripleDottedHalf=30305;
const TripleDottedQuarter=30306;
const TripleDottedSlash8=30307;
const TripleDottedSlash16=30308;
const TripleDottedSlash32=30309;
const TripleDottedSlash64=30310;
const TripleDottedSlash128=30311;
const TripleDottedSlash256=30312;

const ValueToDuration=array(
	 Large=>8,
	 Long=>4,
	 DoubleWhole=>2,
	 Whole=>1,
	 Half=>1/2,
	 Quarter=>1/4,
	 Slash8=>1/8,
	 Slash16=>1/16,
	 Slash32=>1/32,
	 Slash64=>1/64,
	 Slash128=>1/128,
	 Slash256=>1/256,
	 DottedLarge=>8+4,
	 DottedLong=>4+2,
	 DottedDoubleWhole=>2+1,
	 DottedWhole=>1+1/2,
	 DottedHalf=>1/2+1/4,
	 DottedQuarter=>1/4+1/8,
	 DottedSlash8=>1/8+1/16,
	 DottedSlash16=>1/16+1/32,
	 DottedSlash32=>1/32+1/64,
	 DottedSlash64=>1/64+1/128,
	 DottedSlash128=>1/128+1/256,
	 DottedSlash256=>1/256+1/512,
	 DoubleDottedLarge=>8+4+2,
	 DoubleDottedLong=>4+2+1,
	 DoubleDottedDoubleWhole=>2+1+1/2,
	 DoubleDottedWhole=>1+1/2+1/4,
	 DoubleDottedHalf=>1/2+1/4+1/8,
	 DoubleDottedQuarter=>1/4+1/8+1/16,
	 DoubleDottedSlash8=>1/8+1/16+1/32,
	 DoubleDottedSlash16=>1/16+1/32+1/64,
	 DoubleDottedSlash32=>1/32+1/64+128,
	 DoubleDottedSlash64=>1/64+1/128+1/256,
	 DoubleDottedSlash128=>1/128+1/256+1/512,
	 DoubleDottedSlash256=>1/256+1/512+1/1024,
	 TripleDottedLarge=>8+4+2+1,
	 TripleDottedLong=>4+2+1+1/2,
	 TripleDottedDoubleWhole=>2+1+1/2+1/4,
	 TripleDottedWhole=>1+1/2+1/4+1/8,
	 TripleDottedHalf=>1/2+1/4+1/8+1/16,
	 TripleDottedQuarter=>1/4+1/8+1/16+1/32,
	 TripleDottedSlash8=>1/8+1/16+1/32+1/64,
	 TripleDottedSlash16=>1/16+1/32+1/64+1/128,
	 TripleDottedSlash32=>1/32+1/64+1/128+1/256,
	 TripleDottedSlash64=>1/64+1/128+1/256+1/512,
	 TripleDottedSlash128=>1/128+1/256+1/512+1/1024,
	 TripleDottedSlash256=>1/256+1/512+1/1024+1/2048
);

const ValueToCanonical=array(
	Large=>"g",
	Long=>"l",
	DoubleWhole=>"d",
	Whole=>"w",
	Half=>"h",
	Quarter=>"0",
	Slash8=>"1",
	Slash16=>"2",
	Slash32=>"3",
	Slash64=>"4",
	Slash128=>"5",
	Slash256=>"6"
);

function valueToDuration($noteValue) {
	return ValueToDuration[$noteValue];
}

function durationToValue($duration) {
	foreach(ValueToDuration as $value2=>$duration2) {
		if ($duration==$duration2) return $value2;
	}

	return 0;
}

function valueToCanonical($value) {
	return ValueToCanonical[$value];
}

function canonicalToValue($canonical) {
	$canonicalToValue=array_flip(ValueToCanonical);
	return $canonicalToValue[$canonical];
}
?>