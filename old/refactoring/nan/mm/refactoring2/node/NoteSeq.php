<?php
namespace nan\mm\node;

class NoteSeq extends MusicNode {
	var $notes;

	function __construct($notes=[]) {
		parent::__construct();
		$this->notes=$notes;
	}


	static function nw($notes=[]) {
		return new NoteSeq($notes);
	}

	static function clazz() {
		return get_class(NoteSeq::nw());
	}

	function toStringCompact() {
		$s="";
		foreach($this->notes as $note) {
			$s.=($note->toStringCompact());
		}
		return $s;
	}

	function toStringSeparator() {
		return "";
	}
}

?>