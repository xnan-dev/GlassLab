<?php
namespace nan\mm\node;

class Multiplex extends UnaryNode {
	var $channels;
	function __construct($channels=2,$uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		parent::__construct($uniqueNode);
		$this->channels=$channels;
	}

	static function nw($channels=2,$uniqueNode=null) {
		return new Multiplex($channels,$uniqueNode);
	}
	
	function channels() {
		return $this->channels;
	}

	static function clazz() {
		return get_class(Multiplex::nw(1,Note::nw("C")));
	}

	function toStringAttributes() {
		return sprintf("channels:%s",$this->channels);
	}
}

?>