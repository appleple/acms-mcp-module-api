<?php

namespace Acms\Plugins\McpModuleApi\GET\V2\McpModuleApi;

use Acms\Modules\Get\V2\Base;
use Acms\Services\Facades\Database;
use SQL;
use SQL_Select;
use ACMS_Filter;

class Index extends Base
{
    public function get(): array
    {
        $vars = [];
        $sql = $this->buildQuery();
        $q = $sql->get(dsn());

        $modules = Database::query($q, 'all');
        $vars['items'] = $this->buildItems($modules);

        return $vars;
    }

    protected function buildQuery(): SQL_Select
    {
        $sql = SQL::newSelect('module', 'module');
        $sql->addLeftJoin('blog', 'blog_id', 'module_blog_id', 'blog', 'module');
        ACMS_Filter::blogStatus($sql);
        ACMS_Filter::blogTree($sql, $this->bid, $this->blogAxis());
        $sql->addWhereOpr('module_status', 'open');
        return $sql;
    }

    protected function buildItems(array $modules): array
    {
        return array_map(function (array $module) {
            return [
                'id' => $module['module_id'],
                'identifier' => $module['module_identifier'],
                'name' => $module['module_name'],
                'label' => $module['module_label'],
                'description' => $module['module_description'],
                'status' => $module['module_status'],
                'scope' => $module['module_scope'],
                'bid' => $module['module_blog_id'],
                'createdAt' => $module['module_created_datetime'],
                'updatedAt' => $module['module_updated_datetime'],
            ];
        }, $modules);
    }
}
