<?php

interface iNumberValidation{
    public static function isNumber($newValue);
    public static function isPositiveNumber($newValue);
}
interface iColorValidation{
    public static function isColor($newValue);
}
interface iFigureOperations{
    public function perimeter();
    public function area();
}

final class Ponto implements iNumberValidation{
    private $x;
    private $y;

    private function __construct($x, $y){
        if(Ponto::isNumber($x) && Ponto::isNumber($y)){
            $this->x = $x;
            $this->y = $y;
        }
        else{
            throw new Exception("can not create ponto");
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

    public static function isNumber($newValue){
        if(isset($newValue)){
            if(is_numeric($newValue)){
                return $newValue;
            }
            else{
                throw new Exception("value is not numeric");
            }
        }
        else{
            throw new Exception("value is null");
        }
    }
    public static function isPositiveNumber($newValue){
        if(Ponto::isNumber($newValue)){
             if($newValue>0){
                return $newValue;
            }
            else{                
                throw new Exception("value is not a positive number");
             }
        }
    }
}

abstract class Figures2D implements iColorValidation{
    private $color;

    private function __construct($color){
        if(Figures2D::isColor($color)){
            $this->color = $color;
        }
    }

    protected function getColor(){
        return $this->color;
    }
    protected function setColor($newValue){
        $this->color= $newValue;
    }

    public static function isColor($newValue){
        if(isset($newValue)){
            if(is_string($newValue)){
                if(preg_match("/[^a-zA-Z]/",$newValue)){
                    return $newValue;
                }
                else{
                    throw new Exception("color is not only letters");
                }
            }
            else{
                throw new Exception("color is not string");
            }
        }
        else{
            throw new Exception("color is null");
        }
    }
}

class Circles extends Figures2D{
    private $ponto1;
    private $radius;

    private function __construct($x, $y, $radius){
        $this->ponto1 = new Ponto($$x, $y);

    }

}