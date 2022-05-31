<?php
use nan\mm;
use nan\mm\abc;
require_once("autoloader.php");

new mm\MmNs();
new abc\AbcNs();

function test() {
	abc\abc_to_midi("nan/mm/samples/abc/sample1.abc");
}

test();
?>
 