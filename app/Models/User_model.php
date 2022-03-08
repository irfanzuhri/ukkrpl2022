<?php

namespace App\Models;

class User_model extends BaseModel  {

    public static function authenticate($nik, $nama) {
        $data = BaseModel::csvFileToJson("users.csv");
        var_dump($data[0]);
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik && $value['password'] == $nama) {
                return true;
            }
        }
        return false;
    }


    public static function create($nik, $nama) {
        $data = BaseModel::csvFileToJson("users.csv");
        $exists = false;
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik) {
                $exists = true;
            }
        }
       
        if ($exists) {
            return -1;
        }

        file_put_contents("users.csv","\r\n".$nik.",".$nama,FILE_APPEND);
        return 1;
    }

    public static function findByNIK($nik) {
        $data = BaseModel::csvFileToJson("users.csv");
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik) {
                return $value;
            }
        }
        return false;
    }


}