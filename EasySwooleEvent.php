<?php
namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\Bridge\Bridge;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\DbManager;
use Swoole\Coroutine\Scheduler;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        $config = new \EasySwoole\ORM\Db\Config(Config::getInstance()->getConf('MYSQL'));
        $config->setMaxObjectNum(20);//配置连接池最大数量
        DbManager::getInstance()->addConnection(new Connection($config));
        //创建一个协程调度器
        $scheduler = new Scheduler();
        $scheduler->add(function () {
            $builder = new QueryBuilder();
            $builder->raw('select version()');
            DbManager::getInstance()->query($builder, true);
            //这边重置ORM连接池的pool,避免链接被克隆岛子进程，造成链接跨进程公用。
            //DbManager如果有注册多库链接，请记得一并getConnection($name)获取全部的pool去执行reset
            //其他的连接池请获取到对应的pool，然后执行reset()方法
            DbManager::getInstance()->getConnection()->getClientPool()->reset();
        });
        //执行调度器内注册的全部回调
        $scheduler->start();
        //清理调度器内可能注册的定时器，不要影响到swoole server 的event loop
        \Swoole\Timer::clearAll();
    }

    public static function mainServerCreate(EventRegister $register)
    {
        Bridge::getInstance()->setOnStart(function () {
            echo "进程id:" . getmypid();
        });

        // TODO: Implement mainServerCreate() method.
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}