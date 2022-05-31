<?php

namespace nan\mm\node;
use nan\mm;

abstract class MusicNode  {
	var $tag;

	function __construct($tag=null) {
		$this->tag=$tag;
	}	
	
	function name() {
		$n=get_class($this);
		$fg=explode("\\",$n);
		return $fg[count($fg)-1];
	}

	function wrap($m) {
		$wrapped=$m->withUniqueNode($this);
		return $wrapped;
	}

	function withTag($tag) {
		$mm=clone $this;
		$mm->tag=$tag;
		return $mm;
	}

	function tag() {
		return $this->tag;
	}

	function __toString() {
		return $this->toStringCompact();
	}
	
	function toStringTree() {
		$tagStr=("".$this->tag);
		$str=sprintf("%s%s%s",$this->name(),$this->toStringAttributesEnclosed(),$tagStr);
		return $str;
	}

	function toStringCompact() {
		$name=$this->name();
		$tagStr=("".$this->tag);
		$separator=$this->toStringSeparator();
		$attrStr=$this->toStringAttributes();
		return sprintf('%s%s%s%s',$name,$separator,$attrStr,
			$tagStr);
	}	

	function toStringSeparator() {
		return " ";
	}	

	function toStringAttributes() {
		return "";
	}

	function toStringAttributesEnclosed() {
		$s=$this->toStringAttributes();
		if (strlen($s)>0) {
			$s="<$s>";
		}
		return $s;
	}

	function toStringList($list) {
		$s="";
		foreach($list as $li) {
			if (strlen($s)>0) $s.=",";
			$s.=$li;
		}
		$s="[$s]";
		return $s;
	}

	static function clazz() {
		mm\err("should only be called on concrete node classes instead of ".get_class($this));
	}

}

?>