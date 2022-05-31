<?php 
namespace nan\mm\album;


class Song {
	var $arrangements=[];

	function __construct($arrangements=[]) {
		$this->arrangements=$arrangements;
	}

	static function nw() {
		return new Song();
	}

	static function clazz() {
		return get_class(Song::nw());
	}

	function withArrangement($arrangement) {
		$newArrangements=$this->arrangements;
		$newArrangements[]=$arrangement;
		return Song::nw($newArrangements);
	}

	function toStringAttributes() {
		//$notesStr=$this->toStringList($this->notes);
		return "Song";
	}
}

?>