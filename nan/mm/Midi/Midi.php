<?php
namespace nan\mm\Midi;
use nan\mm;
use nan\mm\Pitch;
use nan\mm\Octave;
use nan\mm\Value;
use nan\mm\Arrangement;
use nan\mm\Melody;
use nan\mm\Tone;
use nan\mm\Voice;
use nan\mm\TimeSignature;
use nan\mm\Dynamic\Attack;

Melody\Functions::Load;
Pitch\Functions::Load;
Tone\Functions::Load;
Attack\Functions::Load;
Voice\Functions::Load;
TimeSignature\Functions::Load;

class Functions { const Load=1; }

const MidiC4=60;

function placedToneToMidiNote($placedTone) {
	$octaveMidiNote=MidiC4+(Octave\octaveIndex($placedTone->octave())-4)*12;
	$midiNote=$octaveMidiNote+Pitch\tonePitch($placedTone->tone());
	//print sprintf("dg-octaveMidiNote:$octaveMidiNote pitchFor:%s\n",$placedTone->tone());
	return $midiNote;
}

class ArrangementToMidi {
	var $arrangements=array();
	var $track;

	var $partStartTime=0;
	var $voiceTime=array();
	var $voiceNoteIndex=array();
	var $voiceNotePulse=array();
	var $midi;
	var $maxTime=0;
	var $midiFileName="midi/testMidi.mid";
	var $midiQueue=array();
	var $activeTimeSignature;
	var $ticksPerBeat=100;

	function __construct() {
	}

	static function nw() {
		return new ArrangementToMidi();
	}

	function arrangements() {
		return $this->arrangements;
	}

	function withArrangement($arrangement) {
		$toMidi=clone $this;
		$toMidi->arrangements[]=$arrangement;		
		return $toMidi;
	}

	function track() {
		return $this->track;
	}

	function withTrack($track) {
		$toMidi=clone $this;
		$toMidi->track=$track;
		return $toMidi;
	}

	function withMidiFileName($midiFileName) {
		$toMidi=clone $this;
		$toMidi->midiFileName=$midiFileName;
		return $toMidi;
	}

	function midiFileName() {
		return $this->midiFileName;
	}
	
	function setupStructs($part) {
		$voiceIndex=0;
		$this->voiceTime=array(); // local to part (starts at 0 when part begins)
		$this->voiceNoteIndex=array();
		$this->voiceNotePulse=array();

		foreach($part->voices() as $voice) {
			$this->voiceTime[$voiceIndex]=0;
			$this->voiceNoteIndex[$voiceIndex]=0;
			$this->voiceNotePulse[$voiceIndex]=0;
			++$voiceIndex;		
		}
		$this->activeTimeSignature=$part->timeSignature();
	}

	function setupMidi() {
		$this->midi=new \Midi();
		$this->midi->open($this->ticksPerBeat);
		$this->midi->newTrack();
	}

	function closeMidi() {
		$globalMaxTime=$this->partStartTime+$this->maxTime;
		$msgTrkEnd=sprintf("%s Meta TrkEnd",$globalMaxTime+500);
		//print "msgTrkEnd:$msgTrkEnd\n";
		$this->midi->addMsg(0, $msgTrkEnd);
		$xml=$this->midi->getXml();		
		$this->midi->saveMidFile($this->midiFileName);
		//print "midi_xml:$xml\n";
	}

	function pickVoice($part) {
		$voiceIndex=0;
		$minVoiceTime=PHP_INT_MAX;
		$minVoiceIndex=-1;		

		foreach($part->voices() as $voice) {
			$notesCount=count($voice->chordedNotes());
			$noteIndex=$this->voiceNoteIndex[$voiceIndex];
			$inRange=$noteIndex<$notesCount;
			//print "dg-pickVoice picking: voiceIndex:$voiceIndex inRange ??? noteIndex:$noteIndex<notesCount:$notesCount? $inRange\n";
			if ($inRange) { // if we inRange ??? didn't reach the final note
				$time=$this->voiceTime[$voiceIndex];
				$better=$time<=$minVoiceTime;
				//print "dg-picking voiceTime:$time<=minVoiceTime:$minVoiceTime ? $better \n";
				if ($better) {
					$minVoiceIndex=$voiceIndex;
					$minVoiceTime=$this->voiceTime[$voiceIndex];
				}
			}
			++$voiceIndex;
		}
		//print "dg-pickVoice: minVoiceIndex:$minVoiceIndex\n";
		return $minVoiceIndex;
	}

	function queueMidiMessage($track,$clazz,$time,$message) {
		$this->midiQueue[]=array($time,$clazz,$message);	
	}
	
	function flushMidiQueue() {
		foreach ($this->midiQueue as $timedMessage) {
			$time=$timedMessage[0];
			$clazz=$timedMessage[1];
			$message=$timedMessage[2];
			$this->midi->addMsg(0, $message);
			//print "dg-message:$message\n";
		}			
	}

	function sortMidiQueue() {
		usort($this->midiQueue,array('\\nan\\mm\\Midi\\MidiCompare','midiMessageCompare'));	
	}
	

	function chordedNoteGain($chordedNote,$volume) {
		return Attack\attackGain($chordedNote->attack(),$volume);	
	}
	
	function midiWholeDuration($part) {
		$bpm=$part->tempo()->beatsPerMinute();
		 $midiBaseBpm=120;
		 $bpmRelation=$midiBaseBpm/$bpm;
		$beatDurationSecs=60/$bpm;
		$wholeDurationSecs=4*$beatDurationSecs;
		$wholeDurationTicks=$wholeDurationSecs*$bpmRelation*$this->ticksPerBeat;
		return $wholeDurationTicks;
	}

	function pulseDelta($chordedNote) {
		$noteToWholeRelation=Value\valueToDuration($chordedNote->value());
		$pulseValue=Value\valueToDuration($this->activeTimeSignature->pulseValue());
		$pulseDelta=$noteToWholeRelation/$pulseValue;
		return $pulseDelta;
	}

	function generateVoiceNote($part,$voiceIndex) {
		$noteIndex=$this->voiceNoteIndex[$voiceIndex];
		$voice=$part->voices()[$voiceIndex];
		$chordedNote=$voice->chordedNotes()[$noteIndex];
		$time=$this->voiceTime[$voiceIndex];
		$timeDelta=$this->midiWholeDuration($part)*Value\valueToDuration($chordedNote->value());	
		$pulseDelta=$this->pulseDelta($chordedNote);
		//print "pulseDelta:$pulseDelta\n";

		foreach($chordedNote->placedTones() as $placedTone) {
			$globalTime=$this->partStartTime+$time;
			$globalTimeOff=$this->partStartTime+$time+$timeDelta;
			$globalTimeInt=floor($globalTime);
			$globalTimeOffInt=floor($globalTimeOff);

			if (!Tone\isRest($placedTone->tone())) {
				$midiNote=placedToneToMidiNote($placedTone);			
				//print "*** dg-generateVoiceIndex: voiceIndex:$voiceIndex noteIndex:$noteIndex time:$time globalTime:$globalTime $globalTimeOff placedTone:$placedTone midiNote:$midiNote\n";
				$midiChannel=$voiceIndex+1;
				$volume=80;				
				$pulse=$this->voiceNotePulse[$voiceIndex];
				$chordedNote=TimeSignature\timeSignChordedNote($this->activeTimeSignature,$chordedNote,$pulse);
				$volume=$this->chordedNoteGain($chordedNote,$volume);
				
				$midiMsgOn="$globalTimeInt On ch=$midiChannel n=$midiNote v=$volume";
				$midiMsgOff="$globalTimeOffInt Off ch=$midiChannel n=$midiNote v=$volume";			
				$this->queueMidiMessage(0,"On",$globalTimeInt,$midiMsgOn);			
				$this->queueMidiMessage(0,"Off",$globalTimeOffInt,$midiMsgOff);
			}			
		}		
		$newTime=$time+$timeDelta;
		if ($newTime>$this->maxTime) $this->maxTime=$newTime;
		$this->voiceTime[$voiceIndex]=$newTime;		
		$this->voiceNoteIndex[$voiceIndex]=$this->voiceNoteIndex[$voiceIndex]+1;
		$this->voiceNotePulse[$voiceIndex]=$this->voiceNotePulse[$voiceIndex]+$pulseDelta;
	}

	function writePartNotes($part) {
		$voiceCount=count($part->voices());
		$this->maxTime=0;			
		do {
			$voiceIndex=$this->pickVoice($part);
			$hasNext=$voiceIndex!=-1;
			if ($hasNext) $this->generateVoiceNote($part,$voiceIndex);						
		} while($hasNext);
		$this->partStartTime=$this->partStartTime+$this->maxTime; 
	}

	function writeVoiceInstrumentMidi($part) {
		$voiceIndex=0;
		foreach($part->voices() as $voice) {
			$globalTime=$this->partStartTime;
			$channel=$voiceIndex+1;
			$instrumentMsg = sprintf("$globalTime Meta InstrName \"%s\"",$voice->instrument());
			$programNumber=$this->midi->findGm1InstrumentPatchNumber($voice->instrument());
			$programChangeMsg=sprintf("$globalTime PrCh ch=$channel p=$programNumber");
			$this->queueMidiMessage(0,"Meta",$globalTime,$instrumentMsg);
			$this->queueMidiMessage(0,"PrCh",$globalTime,$programChangeMsg);
			++$voiceIndex;
		}	
	}

	function writeArrangementMidi($arrangement) {
		foreach($arrangement->parts() as $part) {		
			$this->setupStructs($part);
			//$this->midi->setBpm($arrangement->tempo()->beatsPerMinute()); // DO NOT USE. We calculate delta dinamically.
			$this->writeVoiceInstrumentMidi($part);
			$this->writePartNotes($part);					
		}
	}
	
	function writeArrangementsMidi() {		
		foreach($this->arrangements as $arrangement) {
			$this->writeArrangementMidi($arrangement);
		}		
	}

	function toMidi() {
		$this->setupMidi();			
		$this->writeArrangementsMidi();
		$this->sortMidiQueue();
		$this->flushMidiQueue();
		$this->closeMidi();
	}

	function totalTime() {
		return $this->partStartTime+$this->maxTime;
	}

}

/*
	algoritmo: 
	-mientras hay notas sin procesar: 
		-elegir proxima voz (la primera que ya terminó de ejecutar)
		-generar nota de proxima voz
		-aumentar contador de tiempo de la voz		
*/
function arrangementToMidi($arrangement,$midiFileName) {
	$toMidi=ArrangementToMidi::nw()
		->withMidiFileName($midiFileName)
		->withArrangement($arrangement);
	$toMidi->toMidi();
	return $toMidi;
}

function arrangementsToMidi($arrangements,$midiFileName) {
	$toMidi=ArrangementToMidi::nw()
		->withMidiFileName($midiFileName);

	foreach ($arrangements as $arrangement) {
		$toMidi=$toMidi->withArrangement($arrangement);
	}

	$toMidi->toMidi();
	return $toMidi;
}

function partToMidi($part,$midiFileName) {
	return
		ArrangementToMidi::nw()
		->withMidiFileName($midiFileName)
		->withArrangement(
			Arrangement::nw()
				->withPart($part)
			)
		->toMidi();
}

function voiceToMidi($voice,$midiFileName) {
	return partToMidi(Voice\voiceToPart($voice),$midiFileName);
}


function melodyToMidi($melody,$midiFileName) {
	return voiceToMidi(Melody\melodyToVoice($melody),$midiFileName);
}

function textToFileName($text) {
	return str_ireplace(" ","-",$text);
}

function albumTrackToMidi($album,$track,$trackIndex) {
		$midiTrackFileName=textToFileName(sprintf("albums/%s/midi/%s-%s-%s.mid",
				$album->title(),
				$album->title(),
				$trackIndex,
				$track->title()));
		
		$toMidi=arrangementsToMidi($track->arrangements,$midiTrackFileName);
		echo sprintf("albumTrackToMidi: midiTrackFileName: $midiTrackFileName totalTime:%s msg: MIDI file wrote\n",$toMidi->totalTime());
}

function albumTracksToMidi($album) {
	$trackIndex=1;
	foreach($album->tracks() as $track) {
		albumTrackToMidi($album,$track,$trackIndex);
		++$trackIndex;
	}
}

function albumSingleTrackToMidi($album) {
	$midiAlbumFileName=textToFileName(sprintf("albums/%s/midi/%s.mid",$album->title(),$album->title()));

	$toMidi=ArrangementToMidi::nw()
		->withMidiFileName($midiAlbumFileName);
	
	foreach($album->tracks() as $track) {
		foreach ($track->arrangements() as $arrangement) {			
			$toMidi=$toMidi->withArrangement($arrangement);
		}		
	}
	
	echo "albumToMidi: albumFile: $midiAlbumFileName msg: MIDI file wrote\n";
	
	return $toMidi->toMidi();
}

function albumToMidi($album) {
	albumTracksToMidi($album);
	albumSingleTrackToMidi($album);
}

?>