<?php

class FinanceController extends Controller
{
    public function indexAction()
    {
        $this->setTitle("TestAction");
        $this->setView();
        $this->renderLayout();
    }
}
