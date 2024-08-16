<?php 


namespace Charts;
use \App\Model\Crud;


class Graph
{

    public static function getCustomerCharts($ativos=false)
    {
        $model= new Crud();
        $SQL= "SELECT count(uid) as total, dataHoraCadastro FROM clientes";
        if($ativos==true)
        {
            $SQL.= " WHERE ativo='1'";
        }
        $SQL.= "GROUP BY uid ORDER BY dataHoraCadastro DESC";
        $data = $model->aquery($SQL);
        if(empty($data))
        {
            return  ['dataHoraCadastro'=>date('d/m/Y'),'total'=>0];
        }
        if(!empty($data))
        {
            $datas = [];
            $totais = [];
            foreach($data as $k =>$v)
            {
                echo $k.''.$v.'<br>';
            }
        }
    }
    
    
    public static function getProductCharts($ativos=false)
    {
        $model= new Crud();
        $SQL= "SELECT count(uid) as total, dataHoraCadastro FROM produtos";
        if($ativos==true)
        {
            $SQL.= " WHERE ativo='1'";
        }
        $SQL.= "GROUP BY uid ORDER BY dataHoraCadastro DESC";
        $data = $model->aquery($SQL);
        if(empty($data))
        {
            return  ['dataHoraCadastro'=>date('d/m/Y'),'total'=>0];
        }
        if(!empty($data))
        {
            
        }
    }








}


?>