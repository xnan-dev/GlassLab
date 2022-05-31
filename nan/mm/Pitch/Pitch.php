<?php
namespace nan\mm\Pitch;
use nan\mm;
use nan\mm\TwelveTone;
use nan\mm\SevenTone;
use nan\mm\Octave;

SevenTone\Functions::Load;
TwelveTone\Functions::Load;

class Functions { const Load=1; }

function tonePitch($tone) {
	if (SevenTone\isSevenTone($tone)) return SevenTone\sevenTonePitch($tone);
	if (TwelveTone\isTwelveTone($tone)) return TwelveTone\twelveTonePitch($tone);
	throw new \Exception("toneToPitch: FAIL: tone:$tone msg: unrecognized tone");
}

?>