<?php 
namespace app\coment;

class RecusiveCategory 
{
    private $htmlCategory;
    private $htmlOption;
    private $htmlUpdate;
    private $stt;
    private $alert = "'Bạn có chắc muốn xóa không'";
    public function __construct()
    {
        $this->htmlCategory = '';
        $this->htmlOption = '';
        $this->htmlUpdate = '';
        $this->stt = 1;
        
    }
    function category($category,$parent = 0,$char ='')
    {    
        foreach($category as $value){
            if($value['parent_id'] == $parent){
                $this->htmlCategory .= '<tr>';
                $this->htmlCategory .= '<td>'.$this->stt++.'</td>';
                $this->htmlCategory .= '<td>'.$char.$value['name'].'</td>';
                $this->htmlCategory .= '<td>';
                $this->htmlCategory .= '<a href="admin.php?c=category&m=update&id='.$value['id'].'" type="button" class="btn btn-primary"><i class="fas fa-pen"></i></a>&ensp;';
                $this->htmlCategory .= '<a href="admin.php?c=category&m=delete&id='.$value['id'].'" type="button" onclick="return confirm('.$this->alert.');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
                $this->htmlCategory .= '</td>';
                $this->htmlCategory .= '</tr>';
                $this->category($category,$value['id'],$char.'--');
            }
        }
        return $this->htmlCategory;
    }

    function categoryOption($category,$parent = 0,$char ='')
    {
        foreach($category as $value){
            if($value['parent_id'] == $parent){
                $this->htmlOption .= '<option value="'.$value['id'].'">'.$char.$value['name'].'</option>';
                $this->categoryOption($category,$value['id'],$char.'--');
            }
        }
        return $this->htmlOption;
    }

    function updatecate($category,$parent_id)
    {
        foreach($category as $value){
            if($value['id'] == $parent_id){
                $this->htmlUpdate .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                break;
            }
        }
        return $this->htmlUpdate;
    }
}