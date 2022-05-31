<?php
namespace nan\node\reduce;
use nan\mm;

class Up8thMulReducer extends NodeReducer {
	function reduce_Up8thMul($m,$c) {		
		$mo=node\merge::nw($m->nodes())
			->addNode(node\up8th::nw(node\then::nw($m->nodes())));

		print "Nodo8mul:".$mo->toStringTree()."\n";
		return $mo;
	}
}
