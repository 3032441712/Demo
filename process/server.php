<?php
date_default_timezone_set('Asia/Shanghai');
class AppProcess {
    
    public static $host = '';
    
    public static $port = 9876;
    
    public static $pid = 0;
    
    public static $max_process_num = 10;
    
    public static $daemonize = true;
    
    public static $work_pids = [];

    public static function daemonize()
    {
        if(!self::$daemonize)
        {
            return;
        }
        umask(0);
        $pid = pcntl_fork();
        if(-1 == $pid)
        {
            throw new Exception('fork fail');
        }
        elseif($pid > 0)
        {
            exit(0);
        }
        if(-1 == posix_setsid())
        {
            throw new Exception("setsid fail");
        }
        // fork again avoid SVR4 system regain the control of terminal
        $pid = pcntl_fork();
        if(-1 == $pid)
        {
            throw new Exception("fork fail");
        }
        elseif(0 !== $pid)
        {
            exit(0);
        }
    }
    
    public static function setTitle($title)
    {
        cli_set_process_title($title);
    }
    
    public static function work()
    {
        $pid = pcntl_fork();
        if ($pid > 0) {
            self::setTitle('Main Work');
            self::$work_pids[$pid] = $pid;
            // 运行主进程
            self::writeLog('Main Process');
        } elseif (0 === $pid) {
            self::setTitle('Work');
            self::writeLog('Children Process waiting');
            sleep(1);
            exit(0);
        } else {
            throw new Exception("worker fail");
        }
    }

    public static function monitorWorks()
    {
        while (true) {
            $status = 0;
            $pid = pcntl_wait($status, WUNTRACED);
            if ($pid > 0) {
                if (isset(self::$work_pids[$pid]) && $status == 0) {
                    posix_kill($pid, SIGUSR1);
                    unset(self::$work_pids[$pid]);
                }
                self::writeLog('b num:'.$pid.'-'.$status);
            }

            while (count(self::$work_pids) < self::$max_process_num) {
                self::work();
                self::writeLog('c num:'.count(self::$work_pids).'-'.self::$max_process_num);
            }
        }
    }
    
    public static function start()
    {
        self::daemonize();
        self::$pid = posix_getpid();
        file_put_contents('app.pid', self::$pid);

        self::monitorWorks();
    }
    
    public static function stop()
    {
        
    }
    
    public static function restart()
    {
        
    }
    
    public static function status()
    {
        
    }
    
    public static function writeLog($data)
    {
        file_put_contents('app.log', date('Y-m-d H:i:s').' '.$data."\n", FILE_APPEND);
    }
}

$command = isset($argv[1]) ? $argv[1] : '';
switch ($command) {
    case 'start':
        AppProcess::start();
        break;
    case 'stop':
        AppProcess::stop();
        break;
    case 'restart':
        AppProcess::restart();
        break;
    case 'status':
        AppProcess::status();
        break;
    default:
        echo "Please start, stop, restart, status \n";
}
