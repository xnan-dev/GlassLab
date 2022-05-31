<?php
namespace nan\mm\abc;
use nan\mm;
use nan\mm\node;
use nan\mm\reduce;

class AbcPrepareReducer extends reduce\ChainReducer {
	public static function NonPrimitiveReducer() {
		$r=(new reduce\ChainReducer())
			->withReducer(new reduce\ArpReducer())
			->withReducer(new reduce\ChordReducer())
			->withReducer(new reduce\MultiplexReducer())
			//->withReducer(new reduce\Up8thMulReducer())
			;

		return $r;
	}

	public static function PrimitiveSimplifierReducer() {
		$r=(new reduce\ChainReducer())
			->withReducer(new reduce\MeasureReducer())
			//->withReducer(new reduce\TransposeReducer())
			//->withReducer(new reduce\MergeReducer())
			;		
		return $r;
	}
	public static function create() {
		$r=(new AbcPrepareReducer())
			->withReducer(AbcPrepareReducer::NonPrimitiveReducer())
			->withReducer(AbcPrepareReducer::PrimitiveSimplifierReducer());

		return $r;
	}
}


?>