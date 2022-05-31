<?php
namespace nan\mm\reduce;
use nan\mm;
use nan\mm\node;

class NodeReducerContext {} 

class TransposeReducer {
	class ReduceResult {
		var $node;
		var $isReduced;
		function withNode($m) {
			$r=new ReduceResult();
			$r->node=$m;
			$r->isReduced=true;
			return $this;			
		}
		function node() {
			return $this->node;
		}

		function isReduced() {
			return $this->isReduced;
		}
	}
	function reducePassUnary($m,$c) {
		return $m
			->withUniqueNode($this->reduce($m->uniqueNode(),$c));
	}

	function reducePassBinary($m,$c) {
		return $m
			->withFirstNode($this->reduce($m->firstNode(),$c))
			->withSecondNode($this->reduce($m->secondNode(),$c));
	}

	function reducePass($m,$c,&$reduced) {
		if ($m instanceof node\TerminalNode) return $m;		
		if ($m instanceof node\UnaryNode) return $this->reducePassUnary($m,$c,$reduced);
		if ($m instanceof node\BinaryNode) return $this->reducePassBinary($m,$c,$reduced);	
		mm\err("unsupported node type: $m class:".get_class($m));
	}

	function createContext() {
		return new NodeReducerContext();
	}


	function reduceLoop($m,$c,&$reduced) {
		if ($m instanceof Up8th) {
			if ($m->uniqueNode() instanceof Note) { //consumimos up8th
				$reduced=true;
				$t=$note->transposeDistance();
				$note=$note->withTransposeDistance($t);
				return $note;
			} else {
				return $this->reduceDistribute($m,$c);
			}
		} else {
			return reducePass($m,$c);
		}
	}

	function reduce($m,$c=null) {
		if ($m==null) mm\err("reduce call on null");
		if ($c==null) {
			$c=$this->createContext();
		}

		$reduced=false;
		do {
			$reduced=false;
			$this->reduceLoop($m,$c,$reduced);
		} while(!$reduced);
	}
}

?>
