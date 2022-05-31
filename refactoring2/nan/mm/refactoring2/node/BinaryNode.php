<?php

namespace nan\mm\node;

/* 
 * base para nodos del arbol musical.
 *
 * propiedades:
 * -es inmutable
 * 
 */
abstract class BinaryNode extends MusicNode {
	var $firstNode;
	var $secondNode;

	function __construct($firstNode,$secondNode,$tag=null) {
		$this->firstNode=$firstNode;
		$this->secondNode=$secondNode;
		$this->tag=$tag;
	}	
	
	function withNodes($nodes) {
		$mm=clone $this;
		$mm->nodes=$nodes;
		return $mm;
	}	

	function withFirstNode($node) {
		$n=clone $this;
		$n->firstNode=$node;
		return $n;
	}

	function withSecondNode($node) {
		$n=clone $this;
		$n->secondNode=$node;
		return $n;
	}


	function firstNode() {
		return $this->firstNode;		
	}

	function secondNode() {		
		return $this->secondNode;
	}

	function __toString() {
		return $this->toStringCompact();
	}
	
	function toStringTree() {
		$str=sprintf("%s%s%s%s",$this->name(),$this->toStringAttributesEnclosed(),"".$this->tag,$this->toStringNodes(true));
		return $str;
	}

	function toStringCompact() {
		$name=$this->name();
		$compl=$this->toStringAttributesEnclosed();
		$separator=$this->toStringSeparator();
		$nodesStr=$this->firstNode()->__toString().$this->secondNode()->__toString();
		return sprintf('%s%s%s%s%s',$name,$separator,$compl,"".$this->tag,$nodesStr);
	}


	function toStringNodes($asTree=false) {
		$nodesStr="";

		if ($asTree) {
			$separator=" ";
			$toStringFn1=$this->firstNode() instanceof Note ? "toStringCompact" : "toStringTree";
			$toStringFn2=$this->secondNode() instanceof Note ? "toStringCompact" : "toStringTree";
			$nodesStr.=sprintf("[%s%s%s]",$this->firstNode()->$toStringFn1(),$separator,$this->secondNode()->$toStringFn2());

		} else {
			$separator=$this->toStringSeparator();
			$nodesStr.=sprintf("%s%s%s",$this->firstNode()->__toString(),$separator,$this->secondNode()->__toString());
		}

		return $nodesStr;
	}

	function toStringSeparator() {
		return " ";
	}	

}

?>