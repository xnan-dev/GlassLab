<?php
namespace nan\mm\node;

class Tempo extends UnaryNode {
	var $beatNote,$beatsByMinute;
	function __construct($beatNote=1,$beatsByMinute=60,$uniqueNode=null) {
		if ($uniqueNode==null) $uniqueNode=Note::nw();
		parent::__construct($uniqueNode);
		$this->beatNote=$beatNote;
		$this->beatsByMinute=$beatsByMinute;
	}

	static function nw($beatNote=1,$beatsByMinute=60,$uniqueNode=null) {
		return new Tempo($beatNote,$beatsByMinute,$uniqueNode);
	}

	function beatNote() {
		return $this->beatNote;
	}
	function beatsByMinute() {
		return $this->beatsByMinute;
	}

	static function clazz() {
		return get_class(Tempo::nw());
	}

	function toStringAttributes() {
		return sprintf("beatNote:%s,beatsByMinute:%s",$this->beatNote,$this->beatsByMinute);
	}
}

?>