<?php
namespace nan\mm\node;

class Note extends TerminalNode {
	var $note;
	var $duration;
	var $accidentalModifier;
	var $transposeDistance;

	const ACCIDENTAL_MODIFIER_NONE=-999;

	function __construct($note="C",$duration=1,$accidentalModifier=self::ACCIDENTAL_MODIFIER_NONE,$transposeDistance=0) {
		parent::__construct(null);
		$this->note=$note;
		$this->duration=$duration;
		$this->accidentalModifier=$accidentalModifier;
		$this->transposeDistance=$transposeDistance;
	}

	static function nw($note="C",$duration=1,$accidentalModifier=self::ACCIDENTAL_MODIFIER_NONE,$transposeDistance=0) {
		return new Note($note,$duration,$accidentalModifier,$transposeDistance);
	}

	static function clazz() {
		return get_class(Note::nw("C"));
	}

	function transposeDistance() {
		return $this->transposeDistance;
	}

	function withTransposeDistance($d) {
		return Note::nw($this->note,$this->duration,$this->accidentalModifier,$d);
	}

	function note() {
		return $this->note;
	}

	function duration() {
		return $this->duration;
	}

	function withDuration($duration) {
		return Note::nw($this->note,$duration,$this->accidentalModifier,$this->transposeDistance);
	}
	function isSharp() {
		return $this->accidentalModifier==1;
	}

	function sharpPrefix() {
		return "^";
	}

	function isFlat() {
		return $this->accidentalModifier==-1;
	}

	function flatPrefix() {
		return "_";
	}

	function isNatural() {
		return $this->accidentalModifier==0;
	}

	function naturalPrefix() {
		return "=";
	}

	function hasAccidentals() {
		return $this->isFlat() || $this->isNatural() || $this->isSharp();
	}

	function accidental() {
		if ($this->isFlat()) return $this->flatPrefix();
		if ($this->isSharp()) return $this->sharpPrefix();
		if ($this->isNatural()) return $this->naturalPrefix();
		return "";
	}

	function toStringDuration() {
		$d=$this->duration;
		for($i=2;$i<=64;$i++) {
			if ($d==1/$i) return "/$i";		
		}
		return $d==1 ? "" : "".$d;
	}

	function transposeDistanceStr($useBrackets=false) {
		$t=$this->transposeDistance;
		$str="";
		if ($t>0 && $t%12==0) {
			$octaves=$t/12;
			while ($octaves>0) {
				$str.="'";
				--$octaves;
			}
		} else  if ($t<0 && abs($t)%12==0) {
			$octaves=abs($t)/12;
			while ($octaves>0) {
				$str.=",";
				--$octaves;
			}
		} else if ($t!=0) {
			$s=$t>0 ? "+":"";
			$str="tr:$s$t";
			if (strlen($str)>0) $str="<$str>";
		}
		return $str;
	}

	function toStringAttributes() {
		$trStr=$this->transposeDistance;
		$durationStr = $this->duration>1 ? $this->duration : "";
		$accidentalStr=$this->accidental();
		if ($accidentalStr=="") $accidentalStr="none";

		return sprintf("note:%s accidental:%s transposeDistance:%s duration:%s",$this->note,$accidentalStr,$this->transposeDistance,$this->duration);
	}

	function toStringCompact() {
		$trStr=$this->transposeDistanceStr(true);
		$durationStr = $this->duration>1 ? $this->duration : "";
		return sprintf("%s%s%s%s",$this->accidental(),$this->note,$trStr,$durationStr);
	}

	function __toString() {
		return $this->toStringCompact();
	}
}

?>