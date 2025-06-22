<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Model extends Component
{
    public $modelTitle;
    public $modelSubTitle;
    public $cardSize;
    public $model;
    public $controller;
    public $headerfalse;
    public $bodyClass;
    public $bodyClose;
    public function __construct($modelTitle='মডেল টাইটেল', $modelSubTitle ='', $cardSize='500px', $model='false', $controller='', $headerfalse='false', $bodyClass='p-4', $bodyClose = 'false')
    {
        $this->modelTitle = $modelTitle;
        $this->modelSubTitle = $modelSubTitle;
        $this->cardSize = $cardSize;
        $this->model = $model;
        $this->controller = $controller;
        $this->headerfalse = $headerfalse;
        $this->bodyClass = $bodyClass;
        $this->bodyClose = $bodyClose;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.model');
    }
}
