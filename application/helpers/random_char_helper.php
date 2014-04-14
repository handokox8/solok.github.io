<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

function acakangkahuruf($panjang)
{
    $karakter= 'ABCDEFGHIJKL1234567890^()';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter)-1);
        $string .= $karakter{$pos};
    }
    return $string;
}

/* End of file : random_char.php */
/* Location : ./application/helpers/random_char.php */