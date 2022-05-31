<?php
namespace nan\mm\node;

class MusicNodeTag {
	var $transposeDistance;
	function __construct($transposeDistance=0) {
		$this->transposeDistance=$transposeDistance;
	}

	function withTransposeDistance($transposeDistance) {
		return new MusicNodeTag($transposeDistance);
	}
	function transposeDistance() {
		return $this->transposeDistance;
	}
	function __toString() {
		if ($this->transposeDistance!=0) {
			return sprintf("<tr:%s>",$this->transposeDistance);
		} else {
			return "";
		}
	}
}


?>