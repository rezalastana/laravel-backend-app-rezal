<?php

function rupiahFormat($amount)
{
    $rupiah = "Rp " . number_format($amount, 0, ",", ".");
    return $rupiah;
}
