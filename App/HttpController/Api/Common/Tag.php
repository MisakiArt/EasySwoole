<?php

namespace App\HttpController\Api\Common;

use App\Model\Admin\TagModel;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\Http\Message\Status;
use EasySwoole\HttpAnnotation\AnnotationTag\Param;

/**
 * Class Banner
 * Create With Automatic Generator
 */
class Tag extends CommonBase
{

    /**
     * getOne
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author Tioncico
     * Time: 14:03
     */
    public function getOneTag()
    {
        $param = $this->request()->getRequestParam();
        $model = new TagModel();
        $bean = $model->get(['id'=>26580]);
//        go(function (){
//            $ret = [];
//
//            $wait = new \EasySwoole\Component\WaitGroup();
//
//            $wait->add();
//            go(function ()use($wait,&$ret){
//                \co::sleep(0.1);
//                $ret[] = time();
//                $wait->done();
//            });
//
//            $wait->add();
//            go(function ()use($wait,&$ret){
//                \co::sleep(2);
//                $ret[] = time();
//                $wait->done();
//            });
//
//            $wait->wait();
//
//            Logger::getInstance()->info(json_encode($ret));
//        });
        go(function (){
           sleep(1);

        });
        go(function (){
            \co::sleep(1);

        });
        \co::sleep(1);

        if ($bean) {
            $this->writeJson(Status::CODE_OK, $bean, "success");
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
        }
    }
}