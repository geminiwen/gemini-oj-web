<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午2:19
 */

namespace Gemini\Model;


class Problem extends AbstractModel
{
    /**
     * list all
     *
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function listAll($page = 1, $pageSize = 30) {
        return $this->getTable()->listBy([],
                                         $page,
                                         $pageSize,
                                         NULL,
                                         ["id", "title", "accept", "submit"]);
    }

}