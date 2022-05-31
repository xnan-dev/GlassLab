<?php 
namespace nan\mm\album;


class Arrangement {

	function __construct() {
	}

	static function nw() {
		return new Arrangement();
	}

	static function clazz() {
		return get_class(Arrangement::nw());
	}

	function toStringAttributes() {
		//$notesStr=$this->toStringList($this->notes);
		return "Arrangement";
	}
}

?>