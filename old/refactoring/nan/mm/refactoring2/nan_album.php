<?php
namespace nan;
use nan\mm;
use nan\mm\node;
use nan\mm\reduce;
use nan\mm\abc;
use nan\mm\pipe;
require_once("autoloader.php");
new abc\AbcNs();
new mm\MmNs();

function main() {
	$arp1=node\Arp::nw([0,1,2],12,node\Chord::american("Fm"));
	$arp2=node\Arp::nw([0,1,2],12,node\Chord::american("C"));
	$pipe=new pipe\MusicPipe();
	for ($i=0;$i<100;$i++) {
		if ($i==1) $arp1=node\Up8th::nw($arp1);
		if ($i==1) $arp2=node\Up8th::nw($arp2);
		$pipe->addNode($arp1)->addNode($arp2);
	}
	$abc=$pipe->reduceNodes();
	
	print $abc;

	abc\abc_store($abc,"nan_album.abc");
 	abc\abc_to_midi("nan_album.abc"); 
}

main();

?>