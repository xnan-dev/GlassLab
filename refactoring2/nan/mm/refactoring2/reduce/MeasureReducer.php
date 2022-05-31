<?php
namespace nan\mm\reduce;
use nan\mm;
use nan\mm\node;

class MeasureReducer extends NodeReducer {	
	function createContext() {
		return new MeasureContext();
	}

	function nodeDuration($m) {
		if ($m instanceof node\Measure) {
			return 0;
		} else if ($m instanceof node\Note) {
			return $m->duration();
		} else if ($m instanceof node\Then) {
			return $this->nodeDuration($m->firstNode())+
				$this->nodeDuration($m->secondNode());
		} else if ($m instanceof node\merge) {
			return max($this->nodeDuration($m->firstNode()),
				$this->nodeDuration($m->secondNode()));
		} else if ($m instanceof node\UnaryNode) {
			return $this->nodeDuration($m->uniqueNode());
		} else if ($m instanceof node\BinaryNode) {
			return $this->nodeDuration($m->firstNode())+
				$this->nodeDuration($m->secondNode());
		} else if ($m instanceof node\TerminalNode) {
			return 0;
		}
	}

	function insertMeasure($m,$c,&$modified) {
		$nodeDuration=$this->nodeDuration($m);

		if ($m instanceof node\Time) {
			$c=$c->withTime($m);
		}
		$matchDuration=$nodeDuration==$c->time()->quantity();
		$greaterDuration=$nodeDuration>$c->time()->quantity();
		$modified=$modified || $matchDuration;

//		print "insertMeasure m:$m\n";
		if ($matchDuration) {
			return node\Measure::nw($m);
		} else if ($greaterDuration) {
			if ($m instanceof node\UnaryNode) {
				return $m->withUniqueNode($this->insertMeasure($m->uniqueNode(),$c,$modified));
			} else if ($m instanceof node\BinaryNode) {
				return 
					$m->withFirstNode(
						$this->insertMeasure($m->firstNode(),$c,$modified)
					)
					->withSecondNode(
					 	$this->insertMeasure($m->secondNode(),$c,$measure,$modified)
					 )
				;
			} else if ($m instanceof node\TerminalNode) {
				return $m;
			}		
		} else { // minor
			if ($nodeDuration>0) {
				$modified=true;
				return node\Measure::nw($m);				
			} else {
				return $m;
			}
		}		
	}

	function reduce($m,$c=null) {
		if ($c==null) $c=new MeasureContext();
		$modified=false;
		do {
			$modified=false;
			$m=$this->insertMeasure($m,$c,$modified);
		} while ($modified);

		return $m;
	}

}

?>