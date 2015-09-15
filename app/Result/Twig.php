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
//        // add filters
//        foreach ($extends['filters'] as $key => $val) {
//            $this->_twig->addFilter(new \Twig_SimpleFilter($key, $val,
//                ['needs_context' => true, 'needs_environment' => true]));
//        }
//        if (__DEBUG__) {
//        }
        //TODO add debug flag
        $this->_twig->addExtension(new \Twig_Extension_Debug());

        $this->_twig->addFilter(new \Twig_SimpleFilter("result_filter", function ($string) {
            switch ($string) {
                case -2: {
                    return "Waiting";
                }
                case -1: {
                    return "Running";
                }
                case 0: {
                    return "Accepted";
                }
                case 1: {
                    return "Presentation Error";
                }
                case 2: {
                    return "Time Limit Exceeded";
                }
                case 3: {
                    return "Memory Limit Exceeded";
                }
                case 4: {
                    return "Wrong Answer";
                }
                case 5: {
                    return "Runtime Error";
                }
                case 6: {
                    return "Output Limit Exceeded";
                }
                case 7: {
                    return "Compile Error";
                }
                default: {
                    return "System Error";
                }
            }
        }));


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