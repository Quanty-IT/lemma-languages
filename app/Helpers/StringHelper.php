<?php

function capitalizeNameMask(string $name): string
{
    $lowercaseWords = ['de', 'da', 'do', 'das', 'dos', 'a', 'e', 'i', 'o', 'u'];
    $words = explode(' ', strtolower($name));
    $capitalizedWords = [];

    foreach ($words as $index => $word) {
        if ($index !== 0 && in_array($word, $lowercaseWords)) {
            $capitalizedWords[] = $word;
        } else {
            $capitalizedWords[] = ucfirst($word);
        }
    }

    return implode(' ', $capitalizedWords);
}

function sanitizePhoneNumber(string $phone): string
{
    return preg_replace('/\D/', '', $phone);
}
