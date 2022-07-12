<?php
namespace App\Components;

class Recusive
{
    private $html = '';
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    //  HÀM ĐỆ QUY HIỂN THỊ CATEGORIES
    public function showCategories($parent_id, $id = 0, $char = '')
    {
        foreach ($this->data as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id === $id) {
                if (!empty($parent_id) && $parent_id === $item->id) {
                    $this->html .= '<option selected value="' . $item->id . '">' . $char . $item->name . '</option>';
                } else {
                    $this->html .= '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
                }
                $this->showCategories($this->data, $item->id, $char . ' __ ');
            }
        }
        return $this->html;
    }
}

?>
