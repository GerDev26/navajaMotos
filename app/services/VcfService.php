<?php

namespace App\Services;

use JeroenDesloovere\VCard\VCardParser;

class VcfService {
    public static function get_contacts_from_file($vcf){
        $parser = VCardParser::parseFromFile($vcf);
        $contacts = [];
        foreach ($parser as $vcard) {
            if(empty($vcard->fullname) || empty($vcard->phone)) continue;
            $contacts[] = [
                'nombre' => $vcard->fullname,
                'numero' => $vcard->phone['numbers'][0]
            ];
        }

        return $contacts;
    }
}
