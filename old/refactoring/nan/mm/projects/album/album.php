<?php
namespace nan\mm\projects\album;

use nan\mm;
use nan\mm\album;

require_once("autoloader.php");

function song1() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());
}

function song2() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());
}

function song3() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());
}

function song4() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());

}

function song5() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());

}

function song6() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());

}

function song7() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());
}

function song8() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());

}

function song9() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());

}

function song10() {
	return album\Song::nw()
		->withArrangement(album\Arrangement::nw());
}

function album() {
	return album\Album::nw()
		->withSong(song1())
		->withSong(song2())
		->withSong(song3())
		->withSong(song4())
		->withSong(song5())
		->withSong(song6())
		->withSong(song7())
		->withSong(song8())
		->withSong(song9())
		->withSong(song10());
	return $album;
}

function main() {
	album();
}

main();

?>