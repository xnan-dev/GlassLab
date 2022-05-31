<?php
namespace nan\mm\node;

class Then extends BinaryNode {

	function __construct($firstNode=null,$secondNode=null) {
		if ($firstNode==null) $firstNode=Note::nw("C");
		if ($secondNode==null) $secondNode=Note::nw("C");
		parent::__construct($firstNode,$secondNode);
	}


	static function nw($firstNode=null,$secondNode=null) {
		return new then($firstNode,$secondNode);
	}

	static function clazz() {
		return get_class(Then::nw());
	}

	function toStringCompact() {
		return "".($this->toStringNodes());
	}

	function toStringSeparator() {
		return "";
	}
}

?>