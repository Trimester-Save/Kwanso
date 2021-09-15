<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

use Config\Database;

if (!function_exists('getRow')) {

    function getRow($where, $table, $select = NULL)
    {
        $db = Database::connect();
        $builder = $db->table($table);
        if (!is_null($select)) {
            $builder->select($select);
        }
        if (!empty($where)) {
            foreach ($where as $key => $wh) {
                $builder->where($key, $wh);
            }
        }
        return $builder->get()->getRowArray();
    }

}

if (!function_exists('getAllRecords')) {

    function getAllRecords($where, $table, $select = NULL)
    {
        $db = Database::connect();
        $builder = $db->table($table);
        if (!is_null($select)) {
            $builder->select($select);
        }
        if (!empty($where)) {
            foreach ($where as $key => $wh) {
                $builder->where($key, $wh);
            }
        }
        $result = $builder->get();
        return $result->getResultArray();
    }
}

if (!function_exists('getTimeDetails')) {
    function getTimeDetails($updatedTime): string
    {
        $diff = abs(strtotime(date('Y-m-d H:i:s')) - strtotime($updatedTime));
        $temp = $diff / 86400;
        $days = floor($temp);
        $minutes = round($diff / 60);
        $hours = intval($minutes / 60);
        $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($updatedTime);

        if ($minutes > 60) {
            if ($hours > 24) {
                return $days . ' days ago';
            } else {
                return $hours . ' hours ago';
            }
        } else {
            if ($seconds > 60) {
                return $minutes . ' minutes ago';
            } else {
                return $seconds . ' seconds ago';
            }
        }
    }
}

if (!function_exists('generateUuidToken')) {
    function generateUuidToken()
    {
        $db = Database::connect();
        $query = "SELECT UUID()  as uuid";
        return $db->query($query)->getRowArray()['uuid'];
    }
}

if (!function_exists('email_sent')) {
    function email_sent($to, $subject, $html): bool
    {
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom('no-reply@kwanso.ncdcombat.com', 'KWANSO');

        $email->setSubject($subject);
        $email->setMessage($html);

        if ($email->send()) {
            return true;
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
}
