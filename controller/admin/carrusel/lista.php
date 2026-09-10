<?php
use Carrusel\model\CarruselcarruselesModel;
use Carrusel\entity\CarruselcarruselesEntity;
use Franky\Haxor\Tokenizer;

if ($MyRequest->isAjax()) {
        $callback	= $MyRequest->getRequest('callback');
        $filters = $MyRequest->getRequest('filters');
        $dataPost = json_decode(stripslashes($filters),true);
        $dataPost = $dataPost['rules'];
        $requestFranky = [];
        $request = [];
        foreach($dataPost as $data) {
                $request[$data['field']] = $MyRequest->Sanitizacion($data['data']);
        }        
        $sortInput  = (!empty($MyRequest->getRequest('sidx',"createdAt")) ? : "createdAt");
        $Tokenizer = new Tokenizer();
        $CarruselcarruselesModel =  new CarruselcarruselesModel();
        $CarruselcarruselesEntity =  new CarruselcarruselesEntity();
        $CarruselcarruselesModel->setPage($MyRequest->getRequest('page',1));
        $CarruselcarruselesModel->setTampag($MyRequest->getRequest('rows',12));
        $CarruselcarruselesModel->setOrdensql($sortInput." ".$MyRequest->getRequest('sord',"ASC"));


        $result	 = $CarruselcarruselesModel->getData([]);
        $dataRows = ["rows" => [], "total" => ceil($CarruselcarruselesModel->getTotal() / $MyRequest->getRequest('rows',12)), "page" => (int)$MyRequest->getRequest('page',1),"records" => $CarruselcarruselesModel->getTotal()];
    
        if($CarruselcarruselesModel->getTotal() > 0)
        {
                while($registro = $CarruselcarruselesModel->getRows())
                {
                        $registro = array_filter($registro, function($llave) {
                                return !is_numeric($llave);
                        }, ARRAY_FILTER_USE_KEY);               

                        $dataRows['rows'][]= array_merge($registro,array(
                        "id" => $Tokenizer->token("carrusel", $registro["id"]),
                        "callback" => $Tokenizer->token("carrusel", $MyRequest->getURI()),    
                        "createdAt" 	=> getFechaUI($registro["createdAt"]),
                        "status"  => ($registro["status"] == 1 ?"desactivar" : "activar"),
                        ));
                        $iRow++;
                }
        }
        header('Content-Type: application/json; charset=utf-8');
        echo $callback . '(' . json_encode($dataRows). ');';
        die;
} else {
        $MyMetatag->setJs("/public/plugins/jqGrid/js/jquery.jqGrid.js");
        $MyMetatag->setJs("/public/plugins/jqGrid/js/i18n/grid.locale-$lang_root.js");
        $MyMetatag->setCSS("/public/plugins/jqGrid/css/ui.jqgrid.css");
}

?>
