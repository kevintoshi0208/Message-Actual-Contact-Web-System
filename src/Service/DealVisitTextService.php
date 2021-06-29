<?php

namespace App\Service;

class DealVisitTextService
{
    public function dealVisitText($text)
    {
        $text = str_replace(" ","",$text);

        if (preg_match('/([0-9]){15}/', $text, $matches)){
            return ltrim($matches[0],"0");
        }else{
            return  "";
        }
    }
}