<?php
namespace nan\mm\test;
use nan\mm;

new TestNs();
class TestNs {}


function assert_todo($title) {
	print "[TODO] $title\n";
}

function assert_true($title,$bool) {
	if ($bool) {
		print "[PASS] $title\n";
		return true;		
	} else {
		print "[FAIL] $title\n";
		return true;				
	}
}

function assert_equals($title,$a,$b) {
	if ($a==$b) {
		print "[PASS] $title\n";
		return true;
	} else {
		$aStr=$a;
		$bStr=$b;
		if (is_array($a)) {
			$aStr=mm\list2str($a);
		}
		if (is_array($b)) {
			$bStr=mm\list2str($b);
		}
		if ($aStr==$bStr) {
			print "[PASS] $title\n";
		} else {
			print "[FAIL] $title ($aStr != $bStr)\n";
		}
		return false;
	}
}

function assert_tree_equals($title,$m,$str) {
	assert_equals($title,$m->ToStringTree(),$str);
}

function assert_compact_equals($title,$m,$str) {
	assert_equals($title,$m->ToStringCompact(),$str);
}
?>