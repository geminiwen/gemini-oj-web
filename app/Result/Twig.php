<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午1:07
 */

namespace Gemini\Result;


use L8\App;
use L8\Helper\Globals;
use L8\Mvc\Result\AbstractResult;

class Twig extends AbstractResult
{
    use Globals;
    /**
     * @var \Twig_Environment
     */
    private $_twig;
    /**
     * @var array
     */
    private $_data = [];
    /**
     * @var string
     */
    private $_template;
    /**
     * @param $template
     * @param $data
     */
    public function __construct($template, $data = [])
    {
        $loader = new \Twig_Loader_Filesystem(App::prop('result.templateDirectory'));
        $this->_twig = new \Twig_Environment($loader, [
            'cache' =>  false,  //TODO cache
            'debug' =>  true
        ]);
        // add globals
//        $globals = $this->getConfig()->get('twig/globals');
//        foreach ($globals as $key => $val) {
//            $this->_twig->addGlobal($key, $val);
//        }
//        // add extendings
//        $extends = $this->getConfig()->get('twig/extending');
//        // add functions
//        foreach ($extends['functions'] as $key => $val) {
//            $this->_twig->addFunction(new \Twig_SimpleFunction($key, $val,
//                ['needs_context' => true, 'needs_environment' => true]));
//        }
        $this->_twig->addFunction(new \Twig_SimpleFunction("pagenav", function (\Twig_Environment $env, $context, $current, $size, $total, $link) {
            if (0 == $total) {
                return;
            }
            $total = $size > 0 ? max(1, ceil($total / $size)) : 0;
            $html = '<ul class="pagination">';
            $current = min(max(1, $current), $total);
            $from = max(1, $current - 2);
            $to = min($total, $from + 4);
            if ($current > 1) {
                $html .= '<li class="prev"><a rel="prev" href="' . str_replace('#page#', $current - 1, $link) . '">上一页</a></li>';
            }
            if ($from > 1) {
                $html .= '<li><a href="' . str_replace('#page#', 1, $link) . '">1</a></li>';
            }
            if ($from > 2) {
                $html .= '<li class="disabled"><span>&hellip;</span></li>';
            }
            for($i = $from; $i <= $to; $i ++) {
                $html .= '<li' . ($current == $i ? ' class="active"' : '')
                    . '><a href="' . ($current == $i ? 'javascript:void(0);' : str_replace('#page#', $i, $link)) . '">' . $i . '</a></li>';
            }
            if ($to < $total - 1) {
                $html .= '<li class="disabled"><span>&hellip;</span></li>';
            }
            /*
            if ($to < $total) {
                $html .= '<li><a href="' . str_replace('#page#', $total, $link) . '">' . $total . '</a></li>';
            }
            */
            if ($current < $total) {
                $html .= '<li class="next"><a rel="next" href="' . str_replace('#page#', $current + 1, $link) . '">下一页</a></li>';
            }
            $html .= '</ul>';
            if ($total == 1) {
                echo "";  // 内容只有一页时不显示页码
            } else {
                echo $html;
            }
        }, ['needs_context' => true, 'needs_environment' => true]));
//        // add filters
//        foreach ($extends['filters'] as $key => $val) {
//            $this->_twig->addFilter(new \Twig_SimpleFilter($key, $val,
//                ['needs_context' => true, 'needs_environment' => true]));
//        }
//        if (__DEBUG__) {
//        }
        //TODO add debug flag
        $this->_twig->addExtension(new \Twig_Extension_Debug());

        $this->_template = $template;
        $this->_data = $data;
    }
    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setData($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }
    /**
     * 必须实现渲染方法
     *
     * @access public
     * @return void
     */
    public function render()
    {
        ob_start();
        $this->_twig->display($this->_template, $this->_data);
        ob_end_flush();
    }
    /**
     * @return \L8\Helper\Config
     */
    private function getConfig()
    {
        return $this('config');
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return var_export($this->_template, true) . "\n\n" .
        json_encode($this->_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}