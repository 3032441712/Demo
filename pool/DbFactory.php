<?php

require('DbConnect.php');

class DbSession {
    /**
     * @var DbSessionFactory
     */
    public static $session;
}

class DbSessionFactory extends SplStack
{
    // 数据库初始化时，创建的连接个数
    private $initialSize = 10;
    
    // 设置最大并发数
    private $maxActive = 200;
    
    // 当前活动并发数
    public $currentActive = 0;
    
    // 最小空闲连接数
    private $minIdle = 5;
    
    // 数据库最大连接数
    private $maxIdle = 200;
    
    // 最长等待事件,毫秒.
    private $maxWait = 1000;
    
    // 空闲连接5秒中后释放
    private $minEvictableIdleTimeMillis = 5000;
    
    // 5秒检测一次是否有死掉的线程
    private $timeBetweenEvictionRunsMillis = 5000;

    public function __construct()
    {
        for ($i = 1; $i <= $this->getInitialSize(); $i ++) {
            $dbConnect = new DbConnect();
            $dbConnect->setCreated(time());
            $this->addConnect($dbConnect);
        }
    }

    /**
     * 添加数据库连接
     *
     * @return void
     */
    public function addConnect($connect)
    {
        $this->push($connect);
    }

    /**
     * 获取数据库连接
     *
     * @return DbConnect
     */
    public function getConnect()
    {
        $connect = $this->shift();
        $this->currentActive++;
        
        return $connect;
    }

    /**
     *
     * @return the $initialSize
     */
    public function getInitialSize()
    {
        return $this->initialSize;
    }

    /**
     *
     * @return the $maxActive
     */
    public function getMaxActive()
    {
        return $this->maxActive;
    }

    /**
     *
     * @return the $currentActive
     */
    public function getCurrentActive()
    {
        return $this->currentActive;
    }

    /**
     *
     * @return the $minIdle
     */
    public function getMinIdle()
    {
        return $this->minIdle;
    }

    /**
     *
     * @return the $maxIdle
     */
    public function getMaxIdle()
    {
        return $this->maxIdle;
    }

    /**
     *
     * @return the $maxWait
     */
    public function getMaxWait()
    {
        return $this->maxWait;
    }

    /**
     *
     * @return the $minEvictableIdleTimeMillis
     */
    public function getMinEvictableIdleTimeMillis()
    {
        return $this->minEvictableIdleTimeMillis;
    }

    /**
     *
     * @return the $timeBetweenEvictionRunsMillis
     */
    public function getTimeBetweenEvictionRunsMillis()
    {
        return $this->timeBetweenEvictionRunsMillis;
    }

    /**
     *
     * @param number $initialSize            
     */
    public function setInitialSize($initialSize)
    {
        $this->initialSize = $initialSize;
    }

    /**
     *
     * @param number $maxActive            
     */
    public function setMaxActive($maxActive)
    {
        $this->maxActive = $maxActive;
    }

    /**
     *
     * @param number $currentActive            
     */
    public function setCurrentActive($currentActive)
    {
        $this->currentActive = $currentActive;
    }

    /**
     *
     * @param number $minIdle            
     */
    public function setMinIdle($minIdle)
    {
        $this->minIdle = $minIdle;
    }

    /**
     *
     * @param number $maxIdle            
     */
    public function setMaxIdle($maxIdle)
    {
        $this->maxIdle = $maxIdle;
    }

    /**
     *
     * @param number $maxWait            
     */
    public function setMaxWait($maxWait)
    {
        $this->maxWait = $maxWait;
    }

    /**
     *
     * @param number $minEvictableIdleTimeMillis            
     */
    public function setMinEvictableIdleTimeMillis($minEvictableIdleTimeMillis)
    {
        $this->minEvictableIdleTimeMillis = $minEvictableIdleTimeMillis;
    }

    /**
     *
     * @param number $timeBetweenEvictionRunsMillis            
     */
    public function setTimeBetweenEvictionRunsMillis($timeBetweenEvictionRunsMillis)
    {
        $this->timeBetweenEvictionRunsMillis = $timeBetweenEvictionRunsMillis;
    }
}

DbSession::$session = new DbSessionFactory();
$connect = DbSession::$session->getConnect();
echo DbSession::$session->currentActive . "\n";
$connect->close();
echo DbSession::$session->currentActive . "\n";