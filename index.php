<?php

interface iValueValidation{
    public function isPositiveNumber($newValue);
}
interface iFigureOperations{
    public function perimeter();
    public function area();
}

final class Ponto implements iValueValidation{
    private $x;
    private $y;

    private function __construct($x, $y){
        if($this->isPositiveNumber($x) && $this->isPositiveNumber($y)){
            $this->x = $x;
            $this->y = $y;
        }
    }

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
    public function isPositiveNumber($newValue){
        if(isset($newValue)){
            if(is_numeric($newValue)){
                if($newValue>0){
                    return $newValue;
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

abstract class Figures2D{
    private $color;
    protected function getColor(){
        return $this->color;
    }
    protected function setColor($newValue){
        $this->color= $newValue;
    }
}

class Circles extends Figures2D{
    private $ponto1;
    private $radius;


}