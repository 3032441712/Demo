<?php

class DbConnect
{
    // 创建的时间
    private $created = 0;

    private $dbLink = null;

    public function __construct()
    {}

    /**
     *
     * @return the $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     *
     * @return the $dbLink
     */
    public function getDbLink()
    {
        return $this->dbLink;
    }

    /**
     *
     * @param number $created            
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     *
     * @param field_type $dbLink            
     */
    public function setDbLink($dbLink)
    {
        $this->dbLink = $dbLink;
    }

    public function close()
    {
        DbSession::$session->addConnect($this);
        DbSession::$session->setCurrentActive(DbSession::$session->currentActive - 1);
    }
}
