<?php

function encodeIDs($id) {
    $hashids = new Hashids\Hashids(config('app.cipher', 'thuyhu9876'), 12);
    return $hashids->encode($id);
}

function decodeIDs($id) {
    $hashids = new Hashids\Hashids(config('app.cipher', 'thuyhu9876'), 12);
    return $hashids->decode($id);
}
