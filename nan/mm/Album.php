<?php
namespace nan\mm;

class Album {
	var $title="Untitled Album";
	var $tracks=[];

	static function nw() {
		return new Album();
	}

	function title() 
	{
		return $this->title;
	}
	function tracks() {
		return $this->tracks;
	}

	function withTitle($title) {
		$album=clone $this;
		$album->title=$title;
		return $album;
	}

	function withTrack($track) {
		$album=clone $this;
		$album->tracks[]=$track;
		return $album;
	}

	function __toString() {
		return sprintf("Album title:%s",$this->title());
	}	
}

?>