<?php
namespace nan\mm\node;

class Time extends UnaryNode {
	var $quantity;
	var $duration;

	function __construct($quantity,$duration,$uniqueNode) {
		parent::__construct($uniqueNode);
		$this->quantity=$quantity;
		$this->duration=$duration;
	}
	
	static function nw($quantity=4,$duration=4,$uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		return new Time($quantity,$duration,$uniqueNode);
	}

	function quantity() {
		return $this->quantity;
	}
	function duration() {
		return $this->duration;
	}

	function  toStringCompact() {
		return sprintf("(%s/%s)(%s)%s",$this->quantity,$this->duration,$this->uniqueNode()->toStringCompact(),$this->tag());
	}

	function toStringAttributes() {
		return sprintf(sprintf("quantity:%s,duration:%s",$this->quantity,$this->duration));
	}

	static function clazz() {
		return get_class(Time::nw(1,1,Note::nw("C")));
	}

}

?>