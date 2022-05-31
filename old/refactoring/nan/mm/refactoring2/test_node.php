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

function test_note_build() {
	assert_tree_equals("note_A",node\Note::nw("A"),"Note<note:A accidental:none transposeDistance:0 duration:1>");
	assert_compact_equals("note_B",node\Note::nw("B"),"B");
	assert_compact_equals("note_C",node\Note::nw("C"),"C");
	assert_compact_equals("note_D",node\Note::nw("D"),"D");
	assert_compact_equals("note_E",node\Note::nw("E"),"E");
	assert_compact_equals("note_F",node\Note::nw("F"),"F");
	assert_compact_equals("note_G",node\Note::nw("G"),"G");
}

function test_note_accidentals() {
	assert_compact_equals("note_flat",node\Note::nw("_A"),"_A");
	assert_compact_equals("note_natural",node\Note::nw("=A"),"=A");
	assert_compact_equals("note_sharp",node\Note::nw("^A"),"^A");
}

function test_note_transposeDistance() {
	$m=node\Note::nw("C");
	assert_compact_equals("note_transposeDistance1",$m->withTransposeDistance(0),"C");
	assert_compact_equals("note_transposeDistance2",$m->withTransposeDistance(12),"C'");
	assert_compact_equals("note_transposeDistance3",$m->withTransposeDistance(24),"C''");
	assert_compact_equals("note_transposeDistance4",$m->withTransposeDistance(-12),"C,");
	assert_compact_equals("note_transposeDistance5",$m->withTransposeDistance(-24),"C,,");
	assert_compact_equals("note_transposeDistance6",$m->withTransposeDistance(2),"C<tr:+2>");
}

function test_then() {
	assert_tree_equals("then_tree",
		node\Then::nw(node\Note::nw("C"),node\Note::nw("D")),"Then[C D]");
	assert_compact_equals("then_first",
		node\Then::nw(node\Note::nw("C"),node\Note::nw("D"))->firstNode(),"C");
	assert_compact_equals("then_second",
		node\Then::nw(node\Note::nw("C"),node\Note::nw("D"))->secondNode(),"D");
}

function test_parallel() {
	assert_tree_equals("parallel_tree",
		node\Parallel::nw(node\Note::nw("C"),node\Note::nw("D")),"Parallel[C D]");
	assert_compact_equals("parallel_first",
		node\Parallel::nw(node\Note::nw("C"),node\Note::nw("D"))->firstNode(),"C");
	assert_compact_equals("parallel_second",
		node\Parallel::nw(node\Note::nw("C"),node\Note::nw("D"))->secondNode(),"D");
}

function test_merge() {
	assert_tree_equals("merge_tree",
		node\Merge::nw(node\Note::nw("C"),node\Note::nw("D")),"Merge[C D]");
	assert_compact_equals("merge_first",
		node\Merge::nw(node\Note::nw("C"),node\Note::nw("D"))->firstNode(),"C");
	assert_compact_equals("merge_second",
		node\Merge::nw(node\Note::nw("C"),node\Note::nw("D"))->secondNode(),"D");
}

function test_up8th() {
	assert_tree_equals("up8th_tree",
		node\Up8th::nw(node\Note::nw("C")),"Up8th[C]");
	assert_compact_equals("up8th_uniqueNode",
		node\Up8th::nw(node\Note::nw("C"))->uniqueNode(),"C");
}

function test_down8th() {
	assert_tree_equals("down8th_tree",
		node\Down8th::nw(node\Note::nw("C")),"Down8th[C]");
	assert_compact_equals("down8th_uniqueNode",
		node\Down8th::nw(node\Note::nw("C"))->uniqueNode(),"C");
}

function test_rep() {
	assert_tree_equals("rep_tree",
		node\Rep::nw(3,node\Note::nw("C")),"Rep<reps:3>[C]");
	assert_compact_equals("rep_uniqueNode",
		node\Rep::nw(3,node\Note::nw("C"))->uniqueNode(),"C");
}

function test_time() {
	assert_tree_equals("time_tree",
		node\Time::nw(3,4,node\Note::nw("C")),"Time<quantity:3,duration:4>[C]");
	assert_compact_equals("time_uniqueNode",
		node\Time::nw(3,4,node\Note::nw("C"))->uniqueNode(),"C");
}

function test_key() {
	assert_tree_equals("test_key_1",
		node\Key::nw("C",node\Note::nw("C")),"Key<key:C>[C]");
	assert_tree_equals("test_key_2",
		node\Key::nw("G",node\Note::nw("C")),"Key<key:G>[C]");
	assert_compact_equals("time_uniqueNode",
		node\Key::nw("G",node\Note::nw("C"))->uniqueNode(),"C");
}

function test_tempo() {
	assert_tree_equals("tempo_tree",
		node\Tempo::nw(4,60,node\Note::nw("C")),"Tempo<beatNote:4,beatsByMinute:60>[C]");
	assert_compact_equals("tempo_uniqueNode",
		node\Tempo::nw(4,60,node\Note::nw("C"))->uniqueNode(),"C");
}

function test_measure() {
	$m=node\Measure::nw(node\Note::nw("C"));
	assert_tree_equals("measure_tree",$m,"Measure[C]");	
	assert_compact_equals("measure_uniqueNode",$m->uniqueNode(),"C");
}

function test_multiplex() {
	$m=node\Multiplex::nw(3,node\Note::nw("C"));
	assert_tree_equals("multiplex_tree",$m,"Multiplex<channels:3>[C]");	
	assert_compact_equals("multiplex_uniqueNode",$m->uniqueNode(),"C");
}

function test_header() {
	$m=node\Header::nw(["author"=>"nan"],node\Note::nw("C"));
	assert_tree_equals("header_tree",$m,"Header<header:author='nan'>[C]");	
	assert_compact_equals("header_uniqueNode",$m->uniqueNode(),"C");
}

function test_notes() {
	new mm\MmNs();
	assert_compact_equals("notes_c",node\notes("C"),"C");	
	assert_compact_equals("notes_csharp",node\notes("^C"),"^C");	
	assert_compact_equals("notes_cnatural",node\notes("=C"),"=C");	
	assert_compact_equals("notes_cflat",node\notes("_C"),"_C");	
	assert_compact_equals("notes_csharp2",node\notes("^C2"),"^C2");	
	assert_tree_equals("notes_cd",node\notes("CD"),"Then[C D]");	
	assert_tree_equals("notes_cdef",node\notes("CDEF"),"Then[Then[Then[C D] E] F]");	
}

function test_arp() {
	$m=node\Arp::nw([0,1,2],3,node\Chord::american("C"));
	assert_tree_equals("arp_tree",$m,"Arp<orderPattern:[0,1,2],lengthInNotes:3,chord:Chord<notes:[C,E,G]>>");	
}	

function test_chord() {
	$m=node\Chord::nw([node\notes("C"),node\notes("E"),node\notes("G")]);
	assert_tree_equals("chord_tree",$m,"Chord<notes:[C,E,G]>");	
	assert_equals("test_chord_Dm",
		node\Chord::american("Dm")->notes(),["D","F","A"]);
	assert_equals("test_chord_D",
		node\Chord::american("D")->notes(),["D","^F","A"]);
	assert_equals("test_chord_C",
		node\Chord::american("C")->notes(),["C","E","G"]);
	assert_equals("test_chord_Cm",
		node\Chord::american("Cm")->notes(),["C","_E","G"]);
}

function test_nodes() {
	test_note_build();
	test_note_accidentals();
	test_note_transposeDistance();
	test_then();
	test_parallel();
	test_merge();
	test_up8th();
	test_down8th();
	test_rep();
	test_time();
	test_tempo();
	test_measure();
	test_multiplex();
	test_header();
	test_notes();
	test_chord();
	test_arp();
	test_key();
}

function test_nodes_nw() {
	assert_tree_equals("test_node_nw_chord",node\Chord::nw(),"Chord<notes:[C]>");
	assert_tree_equals("test_node_nw_arp",node\Arp::nw(),"Arp<orderPattern:[0],lengthInNotes:1,chord:Chord<notes:[C]>>");
	assert_tree_equals("test_node_nw_header",node\Header::nw(),"Header<header:>[C]");
	assert_tree_equals("test_node_nw_key",node\Key::nw(),"Key<key:C>[C]");
	assert_tree_equals("test_node_nw_measure",node\Measure::nw(),"Measure[C]");
	assert_tree_equals("test_node_nw_merge",node\Merge::nw(),"Merge[C C]");
	assert_tree_equals("test_node_nw_multiplex",node\Multiplex::nw(),"Multiplex<channels:2>[C]");
	assert_equals("test_node_nw_note",node\Note::nw()->toStringCompact(),"C");
	assert_tree_equals("test_node_nw_parallel",node\Parallel::nw(),"Parallel[C C]");
	assert_tree_equals("test_node_nw_rep",node\Rep::nw(),"Rep<reps:2>[C]");
	assert_tree_equals("test_node_nw_tempo",node\Tempo::nw(),"Tempo<beatNote:1,beatsByMinute:60>[C]");
	assert_tree_equals("test_node_nw_then",node\Then::nw(),"Then[C C]");
	assert_tree_equals("test_node_nw_time",node\Time::nw(),"Time<quantity:4,duration:4>[C]");
	assert_tree_equals("test_node_nw_up8th",node\Up8th::nw(),"Up8th[C]");
	assert_tree_equals("test_node_nw_down8th",node\Down8th::nw(),"Down8th[C]");
}

function sample_nodes() {
	return [node\Note::nw(),node\Arp::nw(),node\Chord::nw(),
		node\Down8th::nw(),node\Header::nw(),node\Key::nw(),
		node\Measure::nw(),node\Merge::nw(),node\Multiplex::nw(),
		node\Parallel::nw(),node\Rep::nw(),node\Tempo::nw(),
		node\Then::nw(),node\Time::nw(),node\Up8th::nw(),
	];
}

function test_nodes_clazz() {
	$nodes=sample_nodes();
	foreach($nodes as $node) {
		$node_clazz=$node->clazz();
		$nodeName=$node->name();
		assert_true("test_nodes_clazz nodeName:$nodeName",strlen($node_clazz)>0);
	}
}

// testeos pendientes: nw,toStringCompact,customs-unary,customs-binary
//tag/withTag vs. constructor - definir bien esto.

function test() {
	test_nodes();
	test_nodes_nw();
	test_nodes_clazz();
}

test();

?>
