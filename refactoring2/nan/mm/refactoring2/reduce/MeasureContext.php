<?php
namespace nan\mm\reduce;
use nan\mm;
use nan\mm\node;

class MeasureContext {
	var $time;

	function __construct($time=null) {
		if ($time==null) {
			$this->time=node\time::nw(4,4,node\note::nw("C"));
		} else {
			$this->time=$time;
		}
	}

	function withTime($time) {
		return new MeasureContext($time);
	}
	function time() {
		return $this->time;
	}
}

?>