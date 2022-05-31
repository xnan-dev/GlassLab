<?php 
namespace nan\mm\album;


class Album {
	var $songs;

	function __construct($songs=[]) {
		$this->songs=$songs;
	}

	static function nw() {
		return new Album();
	}

	static function clazz() {
		return get_class(Album::nw());
	}

	function withSong($song) {
		$newSongs=$this->songs;
		$newSongs[]=$song;
		return Album::nw($newSongs);
	}

	function toStringAttributes() {
		//$notesStr=$this->toStringList($this->notes);
		return "album";
	}
}

?>