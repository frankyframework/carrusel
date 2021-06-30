<?php
namespace Carrusel\entity;


class CarruselfotosEntity
{
    private $id;
    private $id_carrusel;
    private $foto;
    private $url;
    private $orden;
    private $status;
    private $createdAt;
    private $updateAt;
  


    public function __construct($data = null)
    {
        if (null != $data) {
            $this->exchangeArray($data);
        }
    }


    public function exchangeArray($data)
    {
        $this->id = (isset($data["id"]) ? $data["id"] : null);
        $this->id_carrusel = (isset($data["id_carrusel"]) ? $data["id_carrusel"] : null);
        $this->foto = (isset($data["foto"]) ? $data["foto"] : null);
        $this->url = (isset($data["url"]) ? $data["url"] : null);
        $this->orden = (isset($data["orden"]) ? $data["orden"] : null);
        $this->status = (isset($data["status"]) ? $data["status"] : null);
        $this->createdAt = (isset($data["createdAt"]) ? $data["createdAt"] : null);
        $this->updateAt = (isset($data["updateAt"]) ? $data["updateAt"] : null);
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setValidation()
    {
        return array(
            "id_carrusel" => array("valor" => $this->id_carrusel,"required")
            );
    }

    

    public function id($id = null){ if($id !== null){ $this->id=$id; }else{ return $this->id; } }

    public function id_carrusel($id_carrusel = null){ if($id_carrusel !== null){ $this->id_carrusel=$id_carrusel; }else{ return $this->id_carrusel; } }

    
    public function foto($foto = null){ if($foto !== null){ $this->foto=$foto; }else{ return $this->foto; } }

   
    public function url($url = null){ if($url !== null){ $this->url=$url; }else{ return $this->url; } }

    public function orden($orden = null){ if($orden !== null){ $this->orden=$orden; }else{ return $this->orden; } }

    public function status($status = null){ if($status !== null){ $this->status=$status; }else{ return $this->status; } }

    public function createdAt($createdAt = null){ if($createdAt !== null){ $this->createdAt=$createdAt; }else{ return $this->createdAt; } }

    public function updateAt($updateAt = null){ if($updateAt !== null){ $this->updateAt=$updateAt; }else{ return $this->updateAt; } }
}
?>
