<?php
/**
 * Local类
 *
 * @category Db
 * @package Db
 * @author zhaoyan <1210965963@qq.com>
 * @license https://github.com/3032441712/person/blob/master/LICENSE GNU License
 * @link http://www.168helps.bom/blog
 */
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'Mysql.php');
class Local
{
    /**
     * 实例化 Mysql
     *
     * @var Mysql
     */
    private static $link = null;

    /**
     * 获取数据类库对象
     *
     * @return Mysql
     */
    private static function getLink()
    {
        if (self::$link instanceof Mysql == false) {
            self::$link = new Mysql('127.0.0.1', 3306, 'zhaoyan', 123123, 'test', 'utf8mb4');
        }
        return self::$link;
    }

    /**
     * 静态魔术方法
     *
     * @param string $name
     *            调用的方法名
     * @param string $args
     *            方法的参数
     *            
     * @return void
     */
    public static function __callStatic($name, $args)
    {
        $callback = array(
            self::getLink(),
            $name
        );
        return call_user_func_array($callback, $args);
    }
}