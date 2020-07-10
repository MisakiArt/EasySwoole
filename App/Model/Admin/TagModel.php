<?php

namespace App\Model\Admin;

use EasySwoole\ORM\AbstractModel;

/**
 * Class AdminModel
 * Create With Automatic Generator
 * @property $adminId
 * @property $adminName
 * @property $adminAccount
 * @property $adminPassword
 * @property $adminSession
 * @property $adminLastLoginTime
 * @property $adminLastLoginIp
 */
class TagModel extends AbstractModel
{
    protected $tableName = 'tags';

    protected $primaryKey = 'id';

    public function getAll(int $page = 1, string $keyword = null, int $pageSize = 10): array
    {
        $where = [];
        if (!empty($keyword))
        {
            $where['name'] = ['%' . $keyword . '%', 'like'];
        }
        $list  = $this->limit($pageSize * ($page - 1), $pageSize)->order($this->primaryKey, 'DESC')->withTotalCount()->all($where);
        $total = $this->lastQueryResult()->getTotalCount();
        return ['total' => $total, 'list' => $list];
    }


}