<?php
namespace nan\mm\abc;
use nan\mm;
use nan\mm\node;
use nan\mm\reduce;

class AbcContext extends reduce\MeasureContext {
	var $voice=0;

	function hasMultipleVoices() {
		return $this->voice!=0;
	}

	function withVoice($index) {
		$m=clone $this;
		$m->voice=$index;
		return $m;
	}

	function voice() {
		return $this->voice;
	}
}

?>