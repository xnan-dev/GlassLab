<?php
namespace nan\node\reduce;
use nan\mm;

class TransposeReducer extends NodeReducer {

}
class Up8thReducer extends NodeReducer {

	function matchConsume($m,$c) {
		return get_class($m)==node\up8th::clazz() && $m->uniqueNodeHasClazz(node\note::clazz());
	}

	function matchThenDistribute($m,$c) {
		return get_class($m)==node\up8th::clazz() && $m->uniqueNodeHasClazz(node\then::clazz());
	}

	function matchParallelDistribute($m,$c) {
		return get_class($m)==node\up8th::clazz() && $m->uniqueNodeHasClazz(node\parallel::clazz());
	}

	function reduceConsume($m,$c) {
		$note=$m->uniqueNode();
		return $note->withTransposeDistance($note->transposeDistance()+12);
	}
	
	function reduceThenDistribute($m,$c) {
		$then=$m->uniqueNode();
		return node\then::nw(
			$this->reduce(node\up8th::nw($then->firstNode()),$c),
			$this->reduce(node\up8th::nw($then->secondNode()),$c)
		);
	}

	function reduceParallelDistribute($m,$c) {
		$then=$m->uniqueNode();
		return node\then::nw(
			$this->reduce(node\up8th::nw($then->firstNode()),$c),
			$this->reduce(node\up8th::nw($then->secondNode()),$c)
		);
	}
	
	function reduce($m,$c=null) {
		$mo=$m;
		if ($this->matchConsume($m,$c)) $mo=$this->reduceConsume($m,$c);
	
		else if ($this->matchThenDistribute($m,$c)) $mo=$this->reduceThenDistribute($m,$c);
	
		else if ($this->matchParallelDistribute($m,$c)) $mo=$this->reduceParallelDistribute($m,$c);
	
		return $mo;
	}
}


?>