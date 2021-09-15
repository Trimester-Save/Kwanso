<?php

namespace Config;

//--------------------------------------------------------------------
// Custom Rule Functions
//--------------------------------------------------------------------

class CustomRules
{
    public function is_lower(string $password): bool
    {
        if (preg_match_all('/[a-z]/', $password) < 1) {
            return FALSE;
        }
        return TRUE;
    }

    public function is_upper(string $password): bool
    {
        if (preg_match_all('/[A-Z]/', $password) < 1) {
            return FALSE;
        }
        return TRUE;
    }

    public function is_number(string $password): bool
    {
        if (preg_match_all('/[0-9]/', $password) < 1) {
            return FALSE;
        }
        return TRUE;
    }

    public function valid_phone_number(string $phone): bool
    {
        if (!is_numeric($phone)) {
            return false;
        } else {
            return true;
        }
    }
}
