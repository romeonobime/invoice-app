<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;

class GenerateInvoiceId extends AbstractIdGenerator
{
    public function generateId(EntityManagerInterface $em, $entity): string
    {
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randomLetters = "";

        for ($i = 0; $i < 2; $i++) {
            $randomLetters .= $alphabet[random_int(0, 25)];
        }

        $digits = "0123456789";
        $randomDigits = "";

        for ($i = 0; $i < 4; $i++) {
            $randomDigits .= $digits[random_int(0, 9)];
        }

        return $randomLetters . $randomDigits;
    }
}