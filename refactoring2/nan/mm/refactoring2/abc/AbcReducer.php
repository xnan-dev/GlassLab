<?php
namespace nan\mm\abc;
use nan\mm;
use nan\mm\node;
use nan\mm\reduce;

class AbcReducer extends StringReducer {
	function reduce($m,$c=null) {
		if ($c==null) $c=$this->createContext();
		$prepareReducer=AbcPrepareReducer::create();
		$translator=AbcTranslator::create();

		$mp=$prepareReducer->reduce($m);
		$abc=$translator->reduce($mp);
		return $abc;
	}	
}

?>