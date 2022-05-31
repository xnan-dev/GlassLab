<?php

namespace nan\mm\node;

class Up8th extends UnaryNode {
	function __construct($uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		parent::__construct($uniqueNode);		
	}

	static function nw($uniqueNode=null) {
		return new Up8th($uniqueNode);
	}

	static function clazz() {
		return get_class(Up8th::nw());
	}
}

?>