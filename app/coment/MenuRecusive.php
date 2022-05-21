<?php 
namespace app\coment;

class MenuRecusive
{
    private $html;

    function menuRecu($category,$id,$stt = 1)
    {
        $cate_chil = [];
        foreach($category as $value){
            if($value['parent_id'] == $id){
                $cate_chil[] = $value;
            }
        }
        if($cate_chil){
            if($stt == 1){
                $this->html .= '<ul class="nav_MenMenu">';
            }elseif($stt == 2){
                $this->html .= '<ul class="dropdown_Men">';
            }elseif($stt == 3){
                $this->html .= '<ul class="dropdown_Men">';
            }
            foreach($cate_chil as $value){
                $this->html .= ' <li class="nav_MenItem">
                <a href="index.php?c=page&cate='.$value['id'].'" class="nav_MenLink">'.$value['name'].'</a>';
                $this->menuRecu($category,$value['id'],$stt+1);
                $this->html .='</li>';
            }
            $this->html .='</ul>';
        }
        return $this->html;
    }

    function getProductPage($category,$cateId)
    {
        global $cate_chil;
        foreach($category as $value){
            if($value['parent_id'] == $cateId){
                $cate_chil[] = $value['id'];
                $this->getProductPage($category,$value['id']);
            }
        }
        
        return $cate_chil;
    }
}