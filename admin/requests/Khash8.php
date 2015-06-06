<?php
class Khash8 {
    function encrypt($stringToEncrypt) {
        $val = '';

        for($i = 0; $i < strlen($stringToEncrypt); $i++) {
            switch(substr($stringToEncrypt, $i, 1)) {
                case 'a': $val .= 'y'; break;
                case 'b': $val .= 'p'; break;
                case 'c': $val .= 'l'; break;
                case 'd': $val .= 't'; break;
                case 'e': $val .= 'a'; break;
                case 'f': $val .= 'v'; break;
                case 'g': $val .= 'k'; break;
                case 'h': $val .= 'r'; break;
                case 'i': $val .= 'e'; break;
                case 'j': $val .= 'z'; break;
                case 'k': $val .= 'g'; break;
                case 'l': $val .= 'm'; break;
                case 'm': $val .= 's'; break;
                case 'n': $val .= 'h'; break;
                case 'o': $val .= 'u'; break;
                case 'p': $val .= 'b'; break;
                case 'q': $val .= 'x'; break;
                case 'r': $val .= 'n'; break;
                case 's': $val .= 'c'; break;
                case 't': $val .= 'd'; break;
                case 'u': $val .= 'i'; break;
                case 'v': $val .= 'j'; break;
                case 'w': $val .= 'f'; break;
                case 'x': $val .= 'q'; break;
                case 'y': $val .= 'o'; break;
                case 'z': $val .= 'w'; break;
                case 'A': $val .= 'Y'; break;
                case 'B': $val .= 'P'; break;
                case 'C': $val .= 'L'; break;
                case 'D': $val .= 'T'; break;
                case 'E': $val .= 'A'; break;
                case 'F': $val .= 'V'; break;
                case 'G': $val .= 'K'; break;
                case 'H': $val .= 'R'; break;
                case 'I': $val .= 'E'; break;
                case 'J': $val .= 'Z'; break;
                case 'K': $val .= 'G'; break;
                case 'L': $val .= 'M'; break;
                case 'M': $val .= 'S'; break;
                case 'N': $val .= 'H'; break;
                case 'O': $val .= 'U'; break;
                case 'P': $val .= 'B'; break;
                case 'Q': $val .= 'X'; break;
                case 'R': $val .= 'N'; break;
                case 'S': $val .= 'C'; break;
                case 'T': $val .= 'D'; break;
                case 'U': $val .= 'I'; break;
                case 'V': $val .= 'J'; break;
                case 'W': $val .= 'F'; break;
                case 'X': $val .= 'Q'; break;
                case 'Y': $val .= 'O'; break;
                case 'Z': $val .= 'W'; break;
                case ' ': $val .= '01'; break;
                case '-': $val .= '02'; break;
                case ',': $val .= '03'; break;
                case '.': $val .= '04'; break;
                case '!': $val .= '05'; break;
                case ':': $val .= '06'; break;
                case ';': $val .= '07'; break;
                case '"': $val .= '08'; break;
                case "'": $val .= '09'; break;
                default: break;
            }
        }

        return $val;
    }

    function decrypt($stringToDecrypt) {
        $val = '';

        for($i = 0; $i < strlen($stringToDecrypt); $i++) {
            switch(substr($stringToDecrypt, $i, 1)) {
                case 'y': $val .= 'a'; break;
                case 'p': $val .= 'b'; break;
                case 'l': $val .= 'c'; break;
                case 't': $val .= 'd'; break;
                case 'a': $val .= 'e'; break;
                case 'v': $val .= 'f'; break;
                case 'k': $val .= 'g'; break;
                case 'r': $val .= 'h'; break;
                case 'e': $val .= 'i'; break;
                case 'z': $val .= 'j'; break;
                case 'g': $val .= 'k'; break;
                case 'm': $val .= 'l'; break;
                case 's': $val .= 'm'; break;
                case 'h': $val .= 'n'; break;
                case 'u': $val .= 'o'; break;
                case 'b': $val .= 'p'; break;
                case 'x': $val .= 'q'; break;
                case 'n': $val .= 'r'; break;
                case 'c': $val .= 's'; break;
                case 'd': $val .= 't'; break;
                case 'i': $val .= 'u'; break;
                case 'j': $val .= 'v'; break;
                case 'f': $val .= 'w'; break;
                case 'q': $val .= 'x'; break;
                case 'o': $val .= 'y'; break;
                case 'w': $val .= 'z'; break;
                case 'Y': $val .= 'A'; break;
                case 'P': $val .= 'B'; break;
                case 'L': $val .= 'C'; break;
                case 'T': $val .= 'D'; break;
                case 'A': $val .= 'E'; break;
                case 'V': $val .= 'F'; break;
                case 'K': $val .= 'G'; break;
                case 'R': $val .= 'H'; break;
                case 'E': $val .= 'I'; break;
                case 'Z': $val .= 'J'; break;
                case 'G': $val .= 'K'; break;
                case 'M': $val .= 'L'; break;
                case 'S': $val .= 'M'; break;
                case 'H': $val .= 'N'; break;
                case 'U': $val .= 'O'; break;
                case 'B': $val .= 'P'; break;
                case 'X': $val .= 'Q'; break;
                case 'N': $val .= 'R'; break;
                case 'C': $val .= 'S'; break;
                case 'D': $val .= 'T'; break;
                case 'I': $val .= 'U'; break;
                case 'J': $val .= 'V'; break;
                case 'F': $val .= 'W'; break;
                case 'Q': $val .= 'X'; break;
                case 'O': $val .= 'Y'; break;
                case 'W': $val .= 'Z'; break;
                case '01': $val .= ' '; break;
                case '02': $val .= '-'; break;
                case '03': $val .= ','; break;
                case '04': $val .= '.'; break;
                case '05': $val .= '!'; break;
                case '06': $val .= ':'; break;
                case '07': $val .= ';'; break;
                case '08': $val .= '"'; break;
                case '09': $val .= "'"; break;
                default: break;
            }
        }

        return $val;
    }

    function hash($stringToHash) {
        $val = '';

        $val = base64_encode($this->encrypt($this->encrypt($this->encrypt($stringToHash))));

        return $val;
    }
}
?>