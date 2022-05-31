<?php
namespace nan\mm\node;

class Measure extends UnaryNode {

	function __construct($uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		parent::__construct($uniqueNode);
	}

	static function nw($uniqueNode=null) {
		return new Measure($uniqueNode);
	}

	static function clazz() {
		return get_class(Measure::nw(Note::nw("C")));
	}
}

?>