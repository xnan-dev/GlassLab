<?php
/*
 * PENDIENTE:
 * - completar casos de test para lo ya hecho
 * - notacion de acordes
 * - precondicion de reducciones? no debería, ver como preservar algebra  
 * - implementar mascaras
 * - eliminar NSs
 * - determinar primitivas: cuales operadores son primitivos?
 */
namespace nan\mm;


class MmNs {
	static $debugEnabled=false;
	static $warnEnabled=false;
	static function debugEnabled() {
		return MmNs::$debugEnabled;
	}

	static function warnEnabled() {
		return MmNs::$warnEnabled;
	}
}

function list2str($arr) {
	$s="";
	foreach ($arr as $v) {
		if (strlen($s)>0) $s.=",";
		$s.="".$v;
	}
	return $s;
}



function warn($msg) {
	if (MmNs::warnEnabled()) {
		echo "warning:$msg\n";		
	}
}

function debug($msg){ 
	if (MmNs::debugEnabled()) {
		echo "debug: $msg\n";
	}
}

function err($msg) {
	$fullMsg="error: $msg\n";
	throw new \exception($fullMsg);
 }
