<?php
interface iFigureOperations{
    public function perimeter();
    public function area();
}

abstract class Figures2D{
    private $x;
    private $y;
    private $color;

    protected function getX(){
        return $this->x;
    }
    protected function setX($newValue){
        $this->x = $newValue;
    }
    protected function getY(){
        return $this->y;
    }
    protected function setY($newValue){
        $this->y = $newValue;
    }
    protected function getColor(){
        return $this->color;
    }
    protected function setColor($newValue){
        $this->color= $newValue;
    }
    private function isPositiveNumber($newValue){
        if(isset($newValue)){
            if(is_numeric($newValue)){
                if($newValue>0){
                    
                }
                else{
                    throw new Exception("value is not a positive number");
                }
            }
            else{
                throw new Exception("value is not numeric");
            }
        }
        else{
            throw new Exception("value is null");
        }
    }

}
