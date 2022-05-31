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

function test_thentolist() {
	$m=node\notes("ABCD");	
	assert_equals("test_thentolist",node\then_to_list($m),"A,B,C,D");	
}

function test_listtothen() {
	$notes=node\then_to_list(node\notes("ABCD"));	
	assert_tree_equals("test_listtothen",node\list_to_then($notes),"Then[Then[Then[A B] C] D]");	
}

function test_testthennotecount() {
	assert_equals("test_testthennotecount",node\then_note_count(node\notes("ABCD")),4);
}

function test_utils() {
	test_thentolist();
	test_listtothen();
	test_testthennotecount();
}
// testeos pendientes: clazz,nw,toStringCompact,customs-unary,customs-binary
//tag/withTag vs. constructor - definir bien esto.
//abstract para method clazz.verificar que esté definido en todos (no está)

function test() {
	test_utils();
}

test();

?>
