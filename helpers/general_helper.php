<?php

/**
 * Check to show active booking date
 *
 * @return boolean
 */
function isBookingDateActive($unixdate) 
{
    return (date('Ymd', $unixdate) == request()->route('date') || ( $unixdate == time() && empty(request()->route('date'))));
}

/**
 * Check date is past date
 *
 * @return boolean
 */
function isPastDate($date)
{
    return strtotime($date) < strtotime(date('Y-m-d'));
}

/**
 * Return logged in user id
 *
 * @return string
 */
function loggedInUserId()
{ 
    return (auth()->check()) ? auth()->user()->id : '';
}

/**
 * Generate a user friendly unique booking reference number
 *
 * @return string
 */
function generateBookingId()
{
    $code       = 'BOOK';//4
    $ymdhis     = date('ymdhis');//12
    $random     = bin2hex(random_bytes(5));//10

    return strtoupper($code . $ymdhis . $random); //26
}