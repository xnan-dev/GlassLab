<?php 

namespace nan\mm\node;

abstract class UnaryNode extends MusicNode {
	var $tag;
	var $firstNode;
	var $secondNode;

	function __construct($uniqueNode,$tag=null) {
		parent::__construct($tag);
		if (!($uniqueNode instanceof MusicNode)) err("uniqueNode $uniqueNode is not a node ($uniqueNode)");
		$this->uniqueNode=$uniqueNode;
	}	
	

	function withUniqueNode($node) {
		$n=clone $this;
		$n->uniqueNode=$node;
		return $n;
	}

	function uniqueNode() {		
		return $this->uniqueNode;
	}

	function uniqueNodeHasClazz($clazz) {
		return get_class($this->uniqueNode)==$clazz;
	}

	function __toString() {
		return $this->toStringCompact();
	}
	
	function toStringTree() {
		$str=sprintf("%s%s%s%s",$this->name(),$this->toStringAttributesEnclosed(),$this->tag,$this->toStringNodes(true));
		return $str;
	}

	function toStringCompact() {
		$name=$this->name();
		$separator=$this->toStringSeparator();
		$nodesStr=$this->toStringNodes(false);	
		return sprintf('%s%s%s%s',$name,$separator,$this->tag,$nodesStr);
	}

	function toStringNodes($asTree) {
		$nodesStr="";
		if ($asTree) {
			$separator=" ";
			$toStringFn=$this->uniqueNode() instanceof Note ? "toStringCompact" : "toStringTree";
			$nodesStr.=sprintf("[%s]",$this->uniqueNode()->$toStringFn());

		} else {
			$nodesStr.=sprintf("%s",$this->uniqueNode()->__toString());
		}

		return $nodesStr;
	}

	function toStringSeparator() {
		return " ";
	}	
}
?>