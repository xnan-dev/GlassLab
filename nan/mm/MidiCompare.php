<?php
namespace nan\mm\Midi;

class MidiCompare {  
	static function midiMessageCompare($a,$b) {
		$a_time=$a[0];
		$b_time=$b[0];
		$a_clazz=$a[1];
		$b_clazz=$a[1];
		
		$a_first=$a_time<$b_time || ($a_time==$b_time && $a_clazz=="On");
		return !$a_first;
	}
}
?>