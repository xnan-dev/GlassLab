<?php
namespace nan\mm;

class Track {
	var $title="Untitled Track";
	var $arrangements=[];

	static function nw() {
		return new Track();
	}

	function title() 
	{
		return $this->title;
	}

	function withTitle($title) {
		$track=clone $this;
		$track->title=$title;
		return $track;
	}

	function arrangements() {
		return $this->arrangements;
	}
	
	function withArrangement($arrangement) {
		$track=clone $this;
		$track->arrangements[]=$arrangement;
		return $track;
	}

	function __toString() {
		return sprintf("Track title:%s",$this->title());
	}	
}

?>