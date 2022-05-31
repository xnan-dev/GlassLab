<?php
namespace nan\mm\pipe;
use nan\mm;
use nan\mm\reduce;
use nan\mm\pipe;

class MusicPipe  {	
	var $nodes=array();
	var $index=0;
	
	function addNode($musicNode) {
		$this->nodes[]=$musicNode;
		return $this;
	}

	function hasMoreNodes() {
		return $this->index<count($this->nodes);
	}

	function nextNode() {
		return $this->nodes[$this->index++];
	}

	function reduceNodes() {
		$r=new reduce\ArpReducer();
		$s="";
		while($this->hasMoreNodes()) {
			$m=$this->nextNode();
			$mo=$r->reduce($m);
			$s.=$mo;
		}

		$abc=<<<_FIN_
X:1
T:nan album
C:Nan
K:Fmaj
M:3/4
Q:0.25=200
|$s
_FIN_;
		return $abc;
	}
}

?>