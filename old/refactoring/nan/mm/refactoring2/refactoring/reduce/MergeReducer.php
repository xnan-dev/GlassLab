<?php
namespace nan\node\reduce;
use nan\mm;


class MergeReducer extends NodeReducer {
	function reduce_merge($m,$c) {
		$parallels=[];
		if (!$m->hasNodes()) return $m;
		$measure_count=count($m->firstNode()->nodes()); // m contiene nodos tipo (then->measure*)
		$nodes=$m->nodes();
		for($i=0;$i<$measure_count;$i++) {
			$p=node\parallel::nw();
			foreach ($nodes as $nj) {
				$measures=$nj->nodes();
				$measure=$measures[$i];
				$p=$p->addNode($measure);
			}
			$parallels[]=$p;
		}		
		
		return node\then::nw($parallels);
	}
}

?>