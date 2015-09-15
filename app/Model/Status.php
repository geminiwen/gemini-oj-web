<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午8:46
 */

namespace Gemini\Model;


class Status extends AbstractModel {

    public function listAll($page, $pageSize) {
        return $this->getTable()->listBy([], $page, $pageSize);
    }
}