<?php

namespace nan\mm\node;

class Down8th extends UnaryNode {
	function __construct($uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		parent::__construct($uniqueNode);		
	}

	static function nw($uniqueNode=null) {
		return new Down8th($uniqueNode);
	}

	static function clazz() {
		return get_class(Down8th::nw());
	}
}

?>
