<?php  if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

function Get_menu($data, $parent = 0) {
    static $i = 1;
    $tab = str_repeat("\t\t", $i);
    if (isset($data[$parent])) {
        $html = "\n$tab<ul>";
        $i++;
        foreach ($data[$parent] as $v) {
            $child = get_menu($data, $v->id_menu);
            $path = base_url('menu/edit_menu/'.$v->id_menu);
            $pathHapus = base_url('menu/del_menu/'.$v->id_menu.'/'.preg_replace("![^a-z0-9]+!i", "-",$v->title));
            $onclick = 'onclick'.'='.'"'.'return confirm('."'".'setuju dihapus?'."'".')'.'"';
            $html .= "\n\t$tab<li>";
            $html .= '<a href="'.$v->url.'">'.$v->title.'</a>'.'<a href='.'"'.$pathHapus.'"'.$onclick.' style="float: right; color: #ff0000"><i class="icon-trash icon-large"></i></a>'.'<a href='.'"'.$path.'"'. 'style="float: right; color: #fff"><i class="icon-edit icon-large"></i></a>';
            $html .= '</li>';
            if ($child) {
                $i--;
                $html .= $child;
                $html .= "\n\t$tab";
            }
            //$html .= '</li>';
        }
        $html .= "\n$tab</ul>";
        return $html;
    } else {
        return false;
    }
}

function Home_menu($data, $parent = 0) {
    static $i = 1;
    $tab = str_repeat("\t\t", $i);
    if (isset($data[$parent])) {
        $html = "\n$tab<ul>";
        $i++;
        foreach ($data[$parent] as $v) {
            $child = home_menu($data, $v->id_menu);
            $html .= "\n\t$tab<li>";
            $html .= '<a href="'.$v->url.'">'.$v->title.'</a>';
            //$html .= '</li>';
            if ($child) {
                $i--;
                $html .= $child;
                $html .= "\n\t$tab";
            }
            $html .= '</li>';
        }
        $html .= "\n$tab</ul>";
        return $html;
    } else {
        return false;
    }
}

/* End of file : menu_helper.php */
/* Location : ./application/helpers/menu_helper.php */