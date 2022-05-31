<?php

namespace nan\mm\node;

class Arp extends TerminalNode {
	var $orderPattern;
	var $lengthInNotes;
	function __construct($orderPattern=[0],$lengthInNotes=1,$chord=null) {
		if ($chord==null) $chord=Chord::nw();
		parent::__construct();
		$this->orderPattern=$orderPattern;
		$this->lengthInNotes=$lengthInNotes;
		$this->chord=$chord;
	}	

	static function nw($orderPattern=[0],$lengthInNotes=1,$chord=null) {	
		return new Arp($orderPattern,$lengthInNotes,$chord);
	}

	function chord() {
		return $this->chord;
	}

	function orderPattern() {
		return $this->orderPattern;
	}

	function toStringAttributes() {
		$orderPatternStr=$this->toStringList($this->orderPattern);
		$chordStr=$this->chord()->toStringTree();
		$lengthInNotes=$this->lengthInNotes;
		return "orderPattern:$orderPatternStr,lengthInNotes:$lengthInNotes,chord:$chordStr";
	}

	function lengthInNotes() {
		return $this->lengthInNotes;
	}

	static function clazz() {
		return get_class(Arp::nw([1],1,Chord::nw("C")));
	}
}

?>
