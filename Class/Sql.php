<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

class Sql
{
    /**
     * @return false|mysqli
     */
    public static function MySqlConn() {
        // 从文件获取数据
        $Array_ConfigData = null;
        $FileData = fopen(dirname(__FILE__,3)."/setting.inc.json",'r');
        while (!feof($FileData))
            $Array_ConfigData .= fgetc($FileData);
        $Array_ConfigData = json_decode($Array_ConfigData,JSON_UNESCAPED_UNICODE);
        fclose($FileData);

        //判断数据库端口
        if($Array_ConfigData['Mysql']['Port'] == 3306 or $Array_ConfigData['Mysql']['Port'] == NULL) $Array_ConfigData['Mysql']['Port'] = 3306;

        return mysqli_connect($Array_ConfigData['Mysql']['Host'],$Array_ConfigData['Mysql']['Username'],$Array_ConfigData['Mysql']['Password'],null,$Array_ConfigData['Mysql']['Port']);
    }

    /**
     * MySQL查找库
     * @param string $Mysql_Query
     * @return string[] 查找到结果返回结果
     */
    public static function SELECT(string $Mysql_Query): array {
        $Array_Push = null;
        $Array_OutPut = [
            'output'=>null,
            'data'=>$Array_Push,
        ];
        if (preg_match('/^SELECT/',$Mysql_Query)) {
            $Result = mysqli_query(self::MySqlConn(),$Mysql_Query);
            for ($CC_i = 0; $Result_Object = mysqli_fetch_object($Result); $CC_i++) {
                if ($CC_i == 0 && empty($Result_Object)) {
                    $Array_OutPut['output'] = 'EmptyResult';
                    return $Array_OutPut;
                } else {
                    $Array_Push[$CC_i] = $Result_Object;
                }
            }
            return $Array_OutPut;
        } else {
            $Array_OutPut['output'] = 'TypeError';
            return $Array_OutPut;
        }
    }

    /**
     * MySQL插入库
     * @param string $Mysql_Query
     * @return bool
     */
    public static function INSERT(string $Mysql_Query): bool {
        if (preg_match('/^INSERT/',$Mysql_Query)) {
            return mysqli_query(self::MySqlConn(),$Mysql_Query);
        } else {
            return false;
        }
    }
}