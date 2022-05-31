<?php
namespace nan\mm;

require("autoloader.php");
include_once("midi_class_v178/classes/midi.class.php");

use nan\mm;
use nan\mm\Midi;
use nan\mm\ChordProgression;
use nan\mm\Voice;
use nan\mm\Tempo;

Midi\Functions::Load;

//TODO: soporte de acentos en notacion americana:!
//TODO: soporte duracion default: 0
//TODO: soporte de octava implicita (más cercana)
//TODO: soporte de cambio de octava implicita
//TODO: soporte de octava default
function melody1() {
	return Melody\americanToMelody("G Bh!  A G! Ch  C C B Bb Bh");
}

function cp1() {
	return ChordProgression\americanToChordProgression("C Dm D#7 Fmaj7 C D");
}

function cp2() {
	return ChordProgression\americanToChordProgression("F F");
}

function cp3() {
	return ChordProgression\americanToChordProgression("G G");
}

function cp4() {
	return ChordProgression\americanToChordProgression("C C D C");
}

function voice11() {
		return ChordProgression\ChordProgressionToVoice::nw()
		->withChordProgression(cp1())
		->withChordToVoice(Chord\ChordToWaltz::nw())
		->toVoice();
}

function voice21() {
		return ChordProgression\ChordProgressionToVoice::nw()
		->withChordProgression(cp2())
		->withChordToVoice(Chord\ChordToWaltz::nw())
		->toVoice();
}

function voice31() {
		return ChordProgression\ChordProgressionToVoice::nw()
		->withChordProgression(cp3())
		->withChordToVoice(Chord\ChordToWaltz::nw())
		->toVoice();
}

function voice41() {
		return ChordProgression\ChordProgressionToVoice::nw()
		->withChordProgression(cp4())
		->withChordToVoice(Chord\ChordToWaltz::nw())
		->toVoice();
}

function part1() {
	return Part\Part::nw()
		->withTempo(Tempo\Tempo::nw()->withBeatsPerMinute(160))
		->withVoice(voice11());
}

function part2() {
	return Part\Part::nw()
		->withTempo(Tempo\Tempo::nw()->withBeatsPerMinute(120))
		->withVoice(voice21());
}

function part3() {
	return Part\Part::nw()
		->withTempo(Tempo\Tempo::nw()->withBeatsPerMinute(60))
		->withVoice(voice31());
}

function part4() {
	return Part\Part::nw()
		->withVoice(voice41());
}

function arrangement1() {
	return Arrangement::nw()
		->withPart(part1());
}

function arrangement2() {
	return Arrangement::nw()
		->withPart(part2());
}

function arrangement3() {
	return Arrangement::nw()
		->withPart(part3());
}

function arrangement4() {
	return Arrangement::nw()
		->withPart(part4());
}

function track1() {
	return Track::nw()
		->withTitle("Joy and Incident")
		->withArrangement(arrangement1());
}

function track2() {
	return Track::nw()
		->withTitle("Descending to Ades")
		->withArrangement(arrangement2());
}

function track3() {
	return Track::nw()
		->withTitle("Ascending from Ades")
		->withArrangement(arrangement3());
}

function track4() {
	return Track::nw()
		->withTitle("Fail")
		->withArrangement(arrangement4());
}


function albumOrfeo() {
	return Album::nw()
		->withTitle("Orfeo")
		->withTrack(track1())
		->withTrack(track2())
		->withTrack(track3())
		->withTrack(track4());
}

function main() {
	//print "track1:".track1()->arrangements()[0]->voices()[0]."\n";
	//Midi\albumTrackToMidi(albumOrfeo(),track1(),1);
	Midi\albumToMidi(albumOrfeo());
}

main();

?>