<?php
namespace nan\mm\test;
use nan\mm;
use nan\mm\node;
use nan\mm\reduce;
use nan\mm\test;

require_once("autoloader.php");

new mm\MmNs();
new node\NodeNs();
new test\TestNs();

function test_multiplexreducer_1() {
	$m=node\Multiplex::nw(3,node\notes("C"));
	$r=new reduce\MultiplexReducer();
	assert_tree_equals("test_multiplexreducer_1",$r->reduce($m),"Merge[C Merge[C C]]");		
}

function test_multiplexreducer_2() {
	$m=node\Multiplex::nw(2,node\notes("CD"));
	$r=new reduce\MultiplexReducer();
	assert_tree_equals("test_multiplexreducer_2",$r->reduce($m),"Merge[Then[C D] Then[C D]]");		
}

function test_multiplexreducer_3() {
	$m=node\Multiplex::nw(2,node\Merge::nw(node\Multiplex::nw(2,node\notes("AB")),node\notes("D")));
	$r=new reduce\MultiplexReducer();
	assert_tree_equals("test_multiplexreducer_3",$r->reduce($m),"Merge[Merge[Merge[Then[A B] Then[A B]] D] Merge[Merge[Then[A B] Then[A B]] D]]");
}

function test_measurereducer_1() {
	$m=node\Time::nw(2,4,node\notes("ABCD"));
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer",$r->reduce($m)->uniqueNode(),"Then[Measure[Then[A B]] Measure[Then[C D]]]");
}

function test_measurereducer_2() {
	$m=node\Time::nw(4,4,node\notes("ABCD"));
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer_2",$r->reduce($m)->uniqueNode(),"Measure[Then[A Then[B Then[C D]]]]");
}

function test_measurereducer_3() {
	$m=node\Time::nw(4,4,node\notes("A"));
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer_3",$r->reduce($m)->uniqueNode(),"Measure[A]");
}

function test_chordreducer() { 
	$m=node\Chord::american("D");
	$r=new reduce\ChordReducer();
	assert_tree_equals("tetest_chordreducer",$r->reduce($m),"Merge[D Merge[^F A]]");
}


class TestReducer extends reduce\NodeReducer {
	function reduceNote($m) {
		return $m->withDuration($m->duration()*2);
	}
}

function test_chainreducer() {
	$m=node\Note::nw("C");
	$r=(new reduce\ChainReducer())
		->withReducer(new TestReducer())
		->withReducer(new TestReducer());

	$mo=$r->reduce($m);
	assert_equals("test_chainreducer","".$mo,"C4");
	assert_todo("verificar que todos los tipos de nodos tengan testeo de sus reducciones especificas (ej arp/chord/rep)");
}

function test_measurereducer21() {
	$m=node\notes("AB");
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer21",$r->reduce($m),"Measure[Then[A B]]");	
}

function test_measurereducer22() {
	$m=node\notes("ABC");
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer22",$r->reduce($m),"Measure[Then[Then[A B] C]]");	
}

function test_measurereducer23() {
	$m=node\notes("ABCD");
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer23",$r->reduce($m),"Measure[Then[Then[Then[A B] C] D]]");	
}

function test_measurereducer24() {
	$m=node\notes("ABCDE");
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer24",$r->reduce($m),"Then[Measure[Then[Then[Then[A B] C] D]] Measure[E]]");	
}

function test_measurereducer25() {
	$m=node\notes("ABCDEF");
	print "arbol:".$m->toStringTree()."\n";
	$r=new reduce\MeasureReducer();
	assert_tree_equals("test_measureReducer25",$r->reduce($m),"Then[Measure[Then[Then[Then[A B] C] D]] Measure[Then[E F]]]");	
}

function test_multiplexreducer() {
	test_multiplexreducer_1();
	test_multiplexreducer_2();
	test_multiplexreducer_3();
}

function test_reducers() {	
/*	test_multiplexreducer();
	test_chainreducer();
	test_measurereducer_1();
	test_measurereducer_2();
	test_measurereducer_3();
	test_chordreducer();*/
	test_measurereducer21();
	test_measurereducer22();
	test_measurereducer23();
	test_measurereducer24();
	test_measurereducer25();
}

function test() {
	test_reducers();
}

test();

?>
