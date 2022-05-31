<?php
namespace nan\mm;

use nan\mm;
use nan\node\abc;
use nan\node\measure;
use nan\node\transpose;
use nan\node\arp;

require_once("autoloader.php");

new node\MmNs();
new abc\ABCNs();

/* ejemplos */
 function ej1_c1() {
 	return notes("C");
 } 

 function ej1_c2() {
 	return notes("CEGB");
 } 
 
 function ej1_cs8() {
 	return notes("CDEFGABAB2B2C2C2");
 }

 function ej11() {
 	return ej1_cs8(); // merge(ej1_cs8()new rep(merge(ej1_cs8(),new rep(ej1_c1(),4)),1);
 }

 function ej12() {
 	return merge(ej1_cs8(),new rep(ej1_c2(),4));
 }

//return new header(new tempo(new key(new time(new merge([new up8th(ej11()),ej11(),new down8th(ej11())]),3,4),"Fmaj"),array("composer"=>"Nan","title"=>"piano exercises"),1/4,300));	

class Ej extends MusicNode {
	function __construct($nodes=[]) {
			parent::__construct("Ej",$nodes);		
	}

	static function ej11() {
		return notes("CDEFGABAB2B2C2C2");		
	}

	static function nw($nodes=[]) {
		return (new Ej($nodes))
			->addNode(key::nw("Fmaj"))
			->addNode(time::nw(3,4))
			->addNode(tempo::nw(1/4,200))
			->addNode(merge::nw()
				->addNode(Ej::ej11())
				->addNode(Ej::ej11()->wrap(up8th::nw()))
				->addNode(Ej::ej11())
				->addNode(Ej::ej11()->wrap(down8th::nw()))
				->wrap(rep::nw(2))			
			)->wrap(header::nw(["composer"=>"Nan","title"=>"piano exercises"]));
	}

}

class Ej2 extends MusicNode {
	function __construct($nodes=[]) {
			parent::__construct("Ej",$nodes);		
	}

	static function phraseA() {
		return notes("ABCD");		
	}

	static function nw($nodes=[]) {
		return (new Ej($nodes))
			->addNode(key::nw("Fmaj"))
			->addNode(time::nw(3,4))
			->addNode(tempo::nw(1/4,200))
			->addNode(Ej2::phraseA())->wrap(header::nw(["composer"=>"Nan","title"=>"piano exercises"]));
	}

}


function main() {
	mm\debug("main");
 	$abcStr=(new abc\AbcReducer())->reduce(Ej2::nw());
 	//$m_measured_tree=$m_measured->toStringTree();
 	//$reducer=new transpose\TransposeReducer();
 	//$reducer2=new merge\MergeReducer();
 	//$m_reduced=$reducer->reduce($m_measured);
 	//$m_reduced2=$reducer2->reduce($m_reduced);
 	//$m_reduced_tree=$m_reduced->toStringTree();
 	//print sprintf("source-melody-measured:$m_measured\n");
 	//print sprintf("source-melody-measured-tree:$m_measured_tree\n");
 	//print sprintf("source-melody-reduced:$m_reduced\n");
 	//print sprintf("source-melody-reduced-tree:$m_reduced_tree\n");
 	//print "source-melody-measured:".$mo->toStringTree()."\n";
 	print "target-abc:\n";
 	print "--------\n";
 	print "$abcStr\n";
 	print "--------\n";
 	abc\abc_store($abcStr,"ej.abc");
 	abc\abc2midi("ej.abc");
 }

print main();

?>