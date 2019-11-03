<?php


class Application {
    private $vars;
    public function __construct($get) {
        $this->vars=$get;
    }
public function run(){
    $controller=new SpreadSheetController();
    $model=$this->router();
    $values=$model->postProcess($controller->GetRange($model));
    return json_encode($values);
}
private function router() {
    if($this->vars["url"]=="/players")
        return new player();
    if($this->vars["url"]=="/winners")
        return new Winners();
    if($this->vars["url"]=="/LastWin")
        return new LastWin($this->vars["id"]);
   
    
}
    
}
