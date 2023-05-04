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
    public static function MySqlConn()
    {
        // 从文件获取数据
        $Array_ConfigData = null;
        $FileData = fopen(dirname(__FILE__, 2) . "/setting.inc.json", 'r');
        while (!feof($FileData))
            $Array_ConfigData .= fgetc($FileData);
        $Array_ConfigData = json_decode($Array_ConfigData, JSON_UNESCAPED_UNICODE);
        fclose($FileData);

        //判断数据库端口
        if ($Array_ConfigData['Mysql']['Port'] == 3306 or $Array_ConfigData['Mysql']['Port'] == NULL) $Array_ConfigData['Mysql']['Port'] = 3306;

        return mysqli_connect($Array_ConfigData['Mysql']['Host'], $Array_ConfigData['Mysql']['Username'], $Array_ConfigData['Mysql']['Password'], null, $Array_ConfigData['Mysql']['Port']);
    }

    /**
     * MySQL查找库 |
     * [Tips] 在PHP中，Mysql查询语句一次只允许查询一次数据，不可多个代码进行连续查询
     * @param string $Mysql_Query 输入Mysql查询语句
     * @return string[] 查找到结果返回结果
     */
    public static function SELECT(string $Mysql_Query): array
    {
        $CC_i = 0;
        $Array_OutPut = [];
        if (preg_match('/^SELECT/', $Mysql_Query)) {
            $Result = mysqli_query(self::MySqlConn(), $Mysql_Query);
            echo mysqli_error(self::MySqlConn());
            for (; $Result_Object = mysqli_fetch_object($Result); $CC_i++) {
                $Array_OutPut['output'] = 'Success';
                $Array_OutPut['data'][$CC_i] = $Result_Object;
            }
            if ($CC_i == 0)
                $Array_OutPut['output'] = 'EmptyResult';
            else mysqli_free_result($Result);
        } else
            $Array_OutPut['output'] = 'TypeError';
        mysqli_close(self::MySqlConn());
        return $Array_OutPut;
    }

    /**
     * MySQL插入库
     * @param string $Mysql_InsertQuery
     * @return bool
     */
    public static function INSERT(string $Mysql_InsertQuery): bool
    {
        if (preg_match('/^INSERT/', $Mysql_InsertQuery))
            return mysqli_query(self::MySqlConn(), $Mysql_InsertQuery);
        else {
            mysqli_close(self::MySqlConn());
            return false;
        }
    }

    /**
     * MySQL更新库
     * @param string $Mysql_UpdateQuery
     * @return bool
     */
    public static function UPDATE(string $Mysql_UpdateQuery): bool
    {
        if (preg_match('/^UPDATE/', $Mysql_UpdateQuery))
            return mysqli_query(self::MySqlConn(), $Mysql_UpdateQuery);
        else {
            mysqli_close(self::MySqlConn());
            return false;
        }
    }

    /**
     * MySQL删除库
     * @param string $Mysql_DeleteQuery
     * @return bool
     */
    public static function DELETE(string $Mysql_DeleteQuery): bool
    {
        if (preg_match('/^DELETE/', $Mysql_DeleteQuery))
            return mysqli_query(self::MySqlConn(), $Mysql_DeleteQuery);
        else {
            mysqli_close(self::MySqlConn());
            return false;
        }
    }
}