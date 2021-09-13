<?php

$streamList = [
    fopen('file.txt','r'),
    fopen('file2.txt','r'),
];

foreach ($streamList as $stream) {
    stream_set_blocking($stream, false);
}

echo fgets($streamList[0]);