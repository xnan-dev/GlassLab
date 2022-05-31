<?php
namespace nan\mm\node;

class Key extends UnaryNode	 {
	var $key;
	function __construct($key="C",$uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		parent::__construct($uniqueNode);
		$this->key=$key;
	}

	static function nw($key="C",$uniqueNode=null) {
		return new key($key,$uniqueNode);
	}

	function key() {
		return $this->key;
	}

	function  toStringCompact() {
		return sprintf("%s:%s",$this->key,$this->toStringNodes());
	}

	function toStringAttributes() {
		$key=$this->key;
		return "key:$key";
	}

	function toStringSeparator() {
		return "";
	}

	static function clazz() {
		return get_class(Key::nw());
	}
}

?>