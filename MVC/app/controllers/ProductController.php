<?php

/**
 * Class ProductController
 */
class ProductController extends Controller
{
    public function indexAction()
    {
        $this->listAction();
    }

    public function listAction()
    {
        $this->setTitle("Товари");
        $this->getModel('Product')
                ->setSortfield($this->getSortParams())
                ->sortCollection();
        $this->setView();
        $this->renderLayout();
    }

    /**
     * @return array
     */
    public function getSortParams()
    {
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else
        {
            $sort = "name";
        }
        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 0;
        }
        return array($sort, $order);
    }
}
