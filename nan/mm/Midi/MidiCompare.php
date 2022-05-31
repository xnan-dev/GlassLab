<?php
namespace nan\mm\Midi;

class MidiCompare {  
	static function midiClazzPririty($clazz) {
		if ($clazz=="Meta") return 3;
		if ($clazz=="PrCh") return 2;
		if ($clazz=="Off") return 1;
		if ($clazz=="On") return 0;	
		return 0;	
	}

	static function midiMessageCompare($a,$b) {
		$a_time=$a[0];
		$b_time=$b[0];
		$a_clazz=$a[1];
		$b_clazz=$b[1];
		
		$a_first=$a_time<$b_time || ($a_time==$b_time 
			&& MidiCompare::midiClazzPririty($a_clazz)>=
				MidiCompare::midiClazzPririty($b_clazz));
		return !$a_first;
	}
}
?>