<?php

namespace Acms\Plugins\McpModuleApi\GET\V2\McpModuleApi;

use Acms\Modules\Get\V2\Base;
use Acms\Services\Template\Twig\GetModule as TwigModule;
use Acms\Services\Api\Exceptions\NotFoundModuleException;
use Acms\Services\Facades\Database;
use SQL;
use ACMS_Filter;

class Detail extends Base
{
    public function get(): array
    {
        $identifier = $this->Get->get('moduleId');
        $moduleName = $this->getModuleName($identifier);

        $engine = new TwigModule();
        $data = $engine->moduleFunction($moduleName, $identifier);

        return $data;
    }

    /**
     * @param string $identifier
     * @return string
     * @throws NotFoundModuleException
     */
    protected function getModuleName($identifier)
    {
        $sql = SQL::newSelect('module');
        $sql->setSelect('module_name');
        $sql->addLeftJoin('blog', 'blog_id', 'module_blog_id');
        ACMS_Filter::blogTree($sql, BID, 'ancestor-or-self');
        $sql->addWhereOpr('module_identifier', $identifier);
        $sql->addWhereOpr('module_status', 'open');
        // $sql->addWhereOpr('module_api_use', 'on');
        $where = SQL::newWhere();
        $where->addWhereOpr('module_blog_id', BID, '=', 'OR');
        $where->addWhereOpr('module_scope', 'global', '=', 'OR');
        $sql->addWhere($where);
        $q = $sql->get(dsn());
        $module = Database::query($q, 'one');

        if (empty($module)) {
            throw new NotFoundModuleException();
        }
        if (strpos($module, 'V2_') !== 0) {
            throw new NotFoundModuleException();
        }
        return $module;
    }
}
