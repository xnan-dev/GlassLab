<?php
namespace nan\mm\abc;
use nan\mm;
use nan\mm\node;
use nan\mm\reduce;

class AbcTranslator extends StringReducer {
	function reduceTempo($m,$c) {
		$n=$m->beatNote();
		$m=$m->beatsByMinute();
		$s="Q:$n=$m\n";
		$s.=$this->reduce($m->uniqueNode(),$c);
		return $s;
	}

	function reduceTime($m,$c) {
		$q=$m->quantity();
		$d=$m->duration();
		$s="|M:$q/$d\n";
		$s.=$this->reduce($m->uniqueNode(),$c);
		return $s;	
	}

	function reduceKey($m,$c) {
		$nodes=$m->nodes();	
		$k=$m->key();
		$s="K:$k\n";
		$s.=$this->reduce($m->uniqueNode(),$c);
		return $s;
	}

	function reduceRep($m,$c) {
		$s="";
		for($i=0;$i<$m->reps();$i++) {
			$s.=$this->reduce($m->uniqueNode(),$c);
		}
		return $s;
	}

	function reduceThen($m,$c) {
		return $this->reduce($m->firstNode(),$c)
			.$this->reduce($m->secondNode(),$c);
	}

	function reduceHeader($m,$c) {
		$nodes=$m->nodes();
		$header=$m->header();
		$composer=$header["composer"];	
		$title=$header["title"];
		$s="X:1\nT:$title\nC:$composer\n";
		return $s.$this->reduce($m->uniqueNode(),$c);
	}

	function reduceNote($m,$c) {
		$t=$m->transposeDistance();
		$up=($t>0);
		$down=($t<0);
		$o=abs($t)/12;

		$octave_suffix="";
		if ($up) {
			while ($o-->0) {$octave_suffix.="'";};
		}
		if ($down) {
			while ($o-->0) {$octave_suffix.=",";};
		}
		return $m->accidental().$m->note().$m->toStringDuration().$octave_suffix;
	}

	function reduceMerge($m,$c) { // TODO URG mergear todos
		return
			$this->reduce($m->firstNode(),$c)
			.$this->reduce($m->secondNode(),$c);
	}

	function reduceMeasure($m,$c) {
		$s="";
		if ($c->hasMultipleVoices()) {
				if ($c->voice()>1) $s.=";";
				$s.="(".($this->reduce($m->uniqueNode(),$c)).")";
		} else {
				$s.="|".($this->reduce($m->uniqueNode(),$c));			
		}
		return $s;
	}

	function reduceParallel($m,$c) {
		print "reduce_measure: ".($m->toStringTree())."\n";
		$s="|";
		$index=1;
		$nodes=[$m->firstNode(),$m->secondNode()];
		foreach($nodes as $ni) {
			$ci=$c->withVoice($index);
			$s.="".($this->reduce($ni,$ci))."";
			++$index;
		}

		return $s;
	}

	function reduce_pass_unary($m,$c) {
		return $m
			->withUniqueNode($this->reduce($m->uniqueNode(),$c));
	}

	function reduce_pass_binary($m,$c) {
		return $m
			->withFirstNode($this->reduce($m->firstNode(),$c))
			->withSecondNode($this->reduce($m->secondNode(),$c));
	}

	function reducePass($m,$c) {	
		if ($m instanceof node\TerminalNode) return $m;		
		if ($m instanceof node\UnaryNode) return $this->reduce_pass_unary($m,$c);
		if ($m instanceof node\BinaryNode) return $this->reduce_pass_binary($m,$c);	
		mm\err("unsupported node type: $m class:".get_class($m));
	}

	public static function create() {
		return new AbcTranslator();
	}

	function createContext() {
		return new AbcContext();
	}
}

?>