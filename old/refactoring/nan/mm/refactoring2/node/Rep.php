<?php

namespace nan\mm\node;

class Rep extends UnaryNode {
	var $reps;
	function __construct($reps=2,$uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		parent::__construct($uniqueNode);
		$this->reps=$reps;
	}

	static function nw($reps=2,$uniqueNode=null) {
		return new Rep($reps,$uniqueNode);
	}

	function reps() {
		return $this->reps;
	}

	function toStringAttributes() {
		return sprintf(sprintf("reps:%s",$this->reps));
	}

	function  toStringCompact() {
		return sprintf("%s*%s",$this->reps,$this->toStringNodes());
	}

	static function clazz() {
		return get_class(Rep::nw(1,Note::nw("C")));
	}
}


?>