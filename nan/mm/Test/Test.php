<?php
namespace nan\mm\Test;
use nan\mm;

class Functions { const Load=1; }

function assertTodo($title) {
	print "[TODO] $title\n";
}

function assertTrue($title,$bool) {
	if ($bool) {
		print "[PASS] $title\n";
		return true;		
	} else {
		print "[FAIL] $title\n";
		return true;				
	}
}

function assertFalse($title,$bool) {
	return assertTrue($title,!$bool);
}

function assertEquals($title,$a,$b) {
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

?>