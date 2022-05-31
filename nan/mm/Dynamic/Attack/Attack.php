<?php
namespace nan\mm\Dynamic\Attack;
use nan\mm;

class Functions { const Load=1; }

const Fortississimo=60001;
const Fortissimo=60002;
const Forte  =60003;
const MezzoForte  =60004;
const MezzoPiano=60005;
const Pianissimo =60006;
const Pianississimo =60007;

const Cressendo=70001;
const Decressendo=70002;
const Diminuendo=70003;
const Morendo=70004;

const NotAccented=80001;
const Accented=80002;
const Marcato=80003;
const Staccato=80004;
const Martellato=80005;



const AttackGain=array(
	NotAccented=>1,
	Accented=>1.2,
	Marcato=>1.2,
	Staccato=>1.2,
	Martellato>=1.2
);


function attackGain($attack,$volume) {
	return $volume*AttackGain[$attack];
}

?>