<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午2:20
 */

namespace Gemini\Model;


use L8\Helper\Globals;

class AbstractModel
{
    use Globals;
    /**
     * @var string
     */
    private $_table;

    /**
     * init table
     */
    public function __construct()
    {
        $parts = explode("\\", get_class($this));
        $this->_table = trim(preg_replace_callback("/[A-Z]/", function ($matches) {
            return '_' . strtolower($matches[0]);
        }, array_pop($parts)), '_');
    }

    /**
     * @param $id
     * @return array
     */
    public function get($id)
    {
        return $this->getTable()->findBy(['id' => $id]);
    }

    /**
     * @param $id
     * @param array $data
     * @return array
     */
    public function set($id, array $data)
    {
        if (!empty($data)) {
            $this->getTable()->setBy(['id' => $id], $data);
        }
        return $this->get($id);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->getTable()->removeBy(['id' => $id]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function add(array $data)
    {
        $insertId = $this->getTable()->add($data);
        $id = isset($data['id']) ? $data['id'] : $insertId;
        return $id ? $this->get($id) : true;
    }

    /**
     * @return \L8\Db\Connector
     */
    public function getDb()
    {
        return $this('db');
    }

    /**
     * \L8\Db\Table
     */
    public function getTable()
    {
        return $this->getDb()->table($this->_table);
    }

    /**
     * @param array $data
     * @param $fields
     * @return array
     */
    public function asValue($data, $fields = NULL)
    {
        $parts = explode('\\', get_class($this));
        $type = array_pop($parts);
        $class = '\Gemini\Value\\' . $type;
        $object = new $class($data);
        $result = $fields ? $object->toArray($fields) : $object;
        return empty($result) && (empty($fields) || is_array($fields)) ? [] : $result;
    }
}