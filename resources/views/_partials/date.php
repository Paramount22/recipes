<?php
function calendar()

{
    $days = [
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday",
        "Saturday"
    ];

    $months = [
        "January", "February", "March", "April", "May", "Jun", "July",
        "August", "September", "October", "November", "December"
    ];


    return $days[Date("w")]. ", ".Date ("j") . "." .$months[Date ("n") - 1]. " " .
        Date ("Y");
}

echo calendar();
