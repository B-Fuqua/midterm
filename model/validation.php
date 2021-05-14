<?php

function validName($name)
{
    return !empty($name);
}

function validChoices($choices)
{
    if ($choices == null)
    {
        return false;
    }
    return count($choices) > 0;
}
