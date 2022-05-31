<?php
namespace nan\mm\reduce;
use nan\mm;
use nan\mm\node;

class ChainReducer extends NodeReducer {
	var $reducers=[];
	
	function __construct($reducers=[]) {
		$this->reducers=$reducers;
	}

	function withReducer($reducer) {
		$newReducers=$this->reducers;
		$newReducers[]=$reducer;
		return new ChainReducer($newReducers);
	}

	function reduce($m,$c=null) {
		mm\debug("ChainReducer: reduce: init");
		$mi=$m;
		foreach($this->reducers as $ri) {
			$ci=$c;
			if ($c==null) {
				$ci=$ri->createContext();
			}
			mm\debug(sprintf("ChainReducer: reduce class:%s input m:%s",get_class($ri),$mi->toStringTree() ));
			$mi=$ri->reduce($mi,$c);
			mm\debug(sprintf("ChainReducer: reduce class:%s output m:%s",get_class($ri),$mi->toStringTree() ));
		}
		return $mi;
	}
}

?>