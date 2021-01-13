<?php

/**
 * Class Controller
 */
class Controller
{

    /**
     * @var null
     */
    protected $title = null;
    /**
     * @var null
     */
    protected $view = null;
    /**
     * @var array
     */
    protected $registry = array();

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $view
     */
    public function setView($view = null)
    {
        if ($view === null) {
            $view = Route::getAction();
        }
        $this->view = $view;
    }

    /**
     * @return null|string
     */
    public function getView()
    {
        return $this->view === null ? '404' : $this->view;
    }

    /**
     * @param $view_name
     */
    public function renderPartialview($view_name)
    {
        $view_path = ROOT . '/app/layouts/' . $view_name . '.php';
        if(file_exists($view_path)) {
            include $view_path;
        }
    }

    /**
     *
     */
    public function renderView()
    {
        $controller = $this->getView() ==="404" ? 'error' : Route::getController();
        $view_path = ROOT . '/app/views/' . strtolower($controller) . '/' . strtolower($this->getView()) . '.php';
        if(file_exists($view_path)) {
            include $view_path;
        }
    }

    /**
     * @param string $layout
     */
    public function renderLayout($layout = "layout")
    {
        if(file_exists(ROOT . '/app/layouts/'.$layout.'.php')) {
            include ROOT . '/app/layouts/'.$layout.'.php';
        }
    }

    /**
     * @param $name
     * @param $args
     * @return bool
     */
    function __call($name, $args)
    {
        switch(true) {
            case substr($name, -6) == "Action";
                $this->setView('404');
                $this->renderLayout('layout_404');
                exit();
            case (substr($name, 0, 3) == "get" && ctype_upper(substr($name, 3, 1)));
                $property = lcfirst(substr($name, 3));
                return $this->$property;
                break;
            case (substr($name, 0, 3) == "set" && ctype_upper(substr($name, 3, 1)));
                $property = lcfirst(substr($name, 3));
                $this->$property = $args[0];
                break;
            default;
                return false;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getModel($name)
    {
        $model = new $name();
        return $model;
    }


}
