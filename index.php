<?php
//! i'm using :: when is protected... is this correct?

echo "working";
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
    public static function perimeter($radius);
    public static function area($radius);
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
final class Circles extends Figures2D implements iFigureOperations{
    private $center;
    private $radius;
    private $perimetro;
    private $area;

    private function __construct($x, $y, $radius){
        if(Figures2D::isPositiveNumber($radius)){
            $this->center = new Ponto($$x, $y);
            $this->radius = $radius;
            $this->perimetro=Circles::perimeter($radius);
            $this->area=Circles::area($radius);
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
            $this->radius = $newValue;
            $this->perimetro=Circles::perimeter($newValue);
            $this->area=Circles::area($newValue);
            return "update successfully";
        }
        else{
            throw new Exception("can not update center of circle");
        }
    }
    public static function perimeter($radius){
        return 2*$radius*M_PI;
    }
    public static function area($radius){
        return pow($radius, 2)*M_PI;
    }
    protected function getPerimeter(){
        return $this->perimetro;
    }
    protected function getArea(){
        return $this->area;
    }

}

final class Rectangles extends Figures2D implements iFigureOperations{
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
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
                $this->ponto4
            );
            $this->perimetro=Rectangles::perimeter($data);
            $this->area=Rectangles::area($data);

        } catch(Exception $error){
            echo 'Caught exception at Rectangles: ',  $error->getMessage(), "\n";
        }
    }
    protected function getPonto1(){
        return $this->ponto1;
    }
    protected function getPonto2(){
        return $this->ponto2;
    }
    protected function getPonto3(){
        return $this->ponto3;
    }
    protected function getPonto4(){
        return $this->ponto4;
    }
    //TODO when they are update de perimeter and area must be as well
    protected function setPonto1($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto1 = new Ponto($newX, $newY);
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
                $this->ponto4
            );
            $this->perimetro=Rectangles::perimeter($data);
            $this->area=Rectangles::area($data);
            return "update ponto1 successfully";
        }
        else{
            throw new Exception("can not update ponto1 of rectangle");
        }
    }
    protected function setPonto2($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto2 = new Ponto($newX, $newY);
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
                $this->ponto4
            );
            $this->perimetro=Rectangles::perimeter($data);
            $this->area=Rectangles::area($data);
            return "update ponto2 successfully";
        }
        else{
            throw new Exception("can not update ponto2 of rectangle");
        }
    }
    protected function setPonto3($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto3 = new Ponto($newX, $newY);
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
                $this->ponto4
            );
            $this->perimetro=Rectangles::perimeter($data);
            $this->area=Rectangles::area($data);
            return "update ponto3 successfully";
        }
        else{
            throw new Exception("can not update ponto3 of rectangle");
        }
    }
    protected function setPonto4($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto4 = new Ponto($newX, $newY);
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
                $this->ponto4
            );
            $this->perimetro=Rectangles::perimeter($data);
            $this->area=Rectangles::area($data);
            return "update ponto4 successfully";
        }
        else{
            throw new Exception("can not update ponto4 of rectangle");
        }
    }
    public static function perimeter($lados){
        return array_sum($lados);
    }
    public static function area($lados){
        $base = $lados[0];
        for ($i = 1; $i<sizeof($lados);$i++){
            if($base !== $lados[$i]){
                $height = $lados[$i];
                break;
            }
        };
        return $base*$height;
    }
    protected function getPerimeter(){
        return $this->perimetro;
    }
    protected function getArea(){
        return $this->area;
    }
}
final class Triangles extends Figures2D implements iFigureOperations{
    private $ponto1;
    private $ponto2;
    private $ponto3;
    private $perimetro;
    private $area;

    private function __construct($ponto1, $ponto2, $ponto3){
        try{
            $this->ponto1 = new Ponto($ponto1[0], $ponto1[1]);
            $this->ponto2 = new Ponto($ponto2[0], $ponto2[1]);
            $this->ponto3 = new Ponto($ponto3[0], $ponto3[1]);

            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
            );
            $this->perimetro=Triangles::perimeter($data);
            $this->area=Triangles::area($data);

        } catch(Exception $error){
            //! throw or echo error
            echo 'Caught exception at Triangles: ',  $error->getMessage(), "\n";
        }
    }
    protected function getPonto1(){
        return $this->ponto1;
    }
    protected function getPonto2(){
        return $this->ponto2;
    }
    protected function getPonto3(){
        return $this->ponto3;
    }
    protected function setPonto1($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto1 = new Ponto($newX, $newY);
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
            );
            $this->perimetro=Triangles::perimeter($data);
            $this->area=Triangles::area($data);
            return "update ponto1 successfully";
        }
        else{
            throw new Exception("can not update ponto1 of triangle");
        }
    }
    protected function setPonto2($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto2 = new Ponto($newX, $newY);
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
            );
            $this->perimetro=Triangles::perimeter($data);
            $this->area=Triangles::area($data);
            return "update ponto2 successfully";
        }
        else{
            throw new Exception("can not update ponto2 of triangle");
        }
    }
    protected function setPonto3($newX, $newY){
        if(Ponto::isNumber($newX) && Ponto::isNumber($newY)){
            $this->ponto3 = new Ponto($newX, $newY);
            $data = array(
                $this->ponto1,
                $this->ponto2,
                $this->ponto3,
            );
            $this->perimetro=Triangles::perimeter($data);
            $this->area=Triangles::area($data);
            return "update ponto3 successfully";
        }
        else{
            throw new Exception("can not update ponto3 of triangle");
        }
    }
    public static function perimeter($lados){
        return array_sum($lados);
    }
    public static function area($lados){
        $halfPerimeter = Triangles::perimeter($lados)/2;
        return sqrt($halfPerimeter*($halfPerimeter-$lados[0])*($halfPerimeter-$lados[1])*($halfPerimeter-$lados[2]));
    }
    protected function getPerimeter(){
        return $this->perimetro;
    }
    protected function getArea(){
        return $this->area;
    }
}