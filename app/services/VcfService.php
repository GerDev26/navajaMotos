<?php

namespace App\Services;

use JeroenDesloovere\VCard\VCardParser;
use stdClass;

class VcfService {
    public static function get_contacts_from_file($vcf){
        $parser = VCardParser::parseFromFile($vcf);
        $contacts = [];
        foreach ($parser as $vcard) {
            if(empty($vcard->fullname) || empty($vcard->phone)) continue;
            $contactKey = $vcard->fullname . $vcard->phone['numbers'][0];
            if (!isset($contactMap[$contactKey])) {
                $contactMap[$contactKey] = true;
                $contact = new stdClass();
                $contact->name = $vcard->fullname;
                $contact->phone_number = $vcard->phone['numbers'][0];
                $contacts[] = $contact;
            }            
        }
        return $contacts;
    }
}
