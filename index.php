<?php
//! i'm using :: when is protected... is this correct?
interface iNumber{
    public static function isNumber($newValue);
}
interface iPositiveNumber{
    public static function isPositiveNumber($newValue);
}
interface iColorValidation{
    public static function isColor($newValue);
}
interface iFigureOperations{
    public function perimeter();
    public function area();
}

final class Ponto implements iNumber{
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
}

abstract class Figures2D implements iColorValidation, iPositiveNumber{
    //TODO private const $id; how to auto increment
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

// TODO: add color atribute
final class Circles extends Figures2D{
    private $center;
    private $radius;
    private $perimetro;
    private $area;

    private function __construct($x, $y, $radius){
        if(Figures2D::isPositiveNumber($radius)){
            $this->center = new Ponto($$x, $y);
            $this->radius = $radius;
        }
        else{
            throw new Exception("can not create circle");
        }
    }
    protected function getCenter(){
        return $this->center;
    }
    protected function setCenter($newValue){
        if(Ponto::isNumber($newValue)){
            $this->center = $newValue;
            return "update successfully";
        }
        else{
            throw new Exception("can not update center of circle");
        }
    }
    protected function getRadius(){
        return $this->radius;
    }
    protected function setRadius($newValue){
        if(Figures2D::isPositiveNumber($newValue)){
            $this->center = $newValue;
            return "update successfully";
        }
        else{
            throw new Exception("can not update center of circle");
        }
    }

}

final class Rectangles extends Figures2D{
    private $ponto1;
    private $ponto2;
    private $ponto3;
    private $ponto4;
    private $perimetro;
    private $area;

    private function __construct($ponto1, $ponto2, $ponto3, $ponto4){
        try{
            $this->ponto1 = new Ponto($ponto1[0], $ponto1[1]);
            $this->ponto2 = new Ponto($ponto2[0], $ponto2[1]);
            $this->ponto3 = new Ponto($ponto3[0], $ponto3[1]);
            $this->ponto4 = new Ponto($ponto4[0], $ponto4[1]);
        } catch(Exception $error){
            echo 'Caught exception at Rectangles: ',  $error->getMessage(), "\n";
        }
    }
    protected function getPonto1(){
        return $this->ponto1;
    }protected function getPonto2(){
        return $this->ponto2;
    }protected function getPonto3(){
        return $this->ponto3;
    }protected function getPonto4(){
        return $this->ponto4;
    }
    //TODO when they are update de perimeter and area must be as well
    protected function setPonto1($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto1 = new Ponto($newX, $newY);
            return "update ponto1 successfully";
        }
        else{
            throw new Exception("can not update ponto1 of rectangle");
        }
    }
    protected function setPonto2($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto2 = new Ponto($newX, $newY);
            return "update ponto2 successfully";
        }
        else{
            throw new Exception("can not update ponto2 of rectangle");
        }
    }
    protected function setPonto3($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto3 = new Ponto($newX, $newY);
            return "update ponto3 successfully";
        }
        else{
            throw new Exception("can not update ponto3 of rectangle");
        }
    }
    protected function setPonto4($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto4 = new Ponto($newX, $newY);
            return "update ponto4 successfully";
        }
        else{
            throw new Exception("can not update ponto4 of rectangle");
        }
    }
}
final class Triangles extends Figures2D{

}