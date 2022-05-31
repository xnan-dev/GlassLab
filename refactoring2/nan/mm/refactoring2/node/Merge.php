<?php

namespace nan\mm\node;

class Merge extends BinaryNode {
	function __construct($firstNode=null,$secondNode=null) {
		if ($firstNode==null) $firstNode=Note::nw();
		if ($secondNode==null) $secondNode=Note::nw();
		parent::__construct($firstNode,$secondNode);
	}

	static function nw($firstNode=null,$secondNode=null) {
		return new Merge($firstNode,$secondNode);
	}

	static function clazz() {
		return get_class(Merge::nw());
	}
}

?>