<?php

$streamList = [
    stream_socket_client('tcp://localhost:8080'),
    fopen('file.txt','r'),
    fopen('file2.txt','r'),
];

fwrite($streamList[0], 'GET /http-server.php HTTP/1.1' . PHP_EOL . PHP_EOL);
foreach ($streamList as $stream) {
    stream_set_blocking($stream, false);
}

do {

    $copyReadStream = $streamList;
    $numeroDeStreams = stream_select($copyReadStream, $write, $except, 0, 200000);

    if($numeroDeStreams === 0) {
        continue;
    }

    foreach($copyReadStream as $key => $stream){
        $content = stream_get_contents($stream);
        $posicaoFimHttp = strpos($content, "\r\n\r\n");
        if($posicaoFimHttp !== false){
            echo substr($content, $posicaoFimHttp + 4);
        } else {
            echo $content;
        }
        //echo fgets($stream);
        unset($streamList[$key]);
    }

} while (!empty($streamList));

echo "Li todos os streams" . PHP_EOL;