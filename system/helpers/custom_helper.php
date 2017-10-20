<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @return string[36]
 */
function createId()
{
    $id = md5(time());
    $stringToRandom = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < 4; $i++) {
        $id .= $stringToRandom[rand(0, 61)];
    }
    return $id;
}

/**
 * @param array $arr
 * @param string $keySelected (nếu là multiple select thì keyselect là array)
 * @param array $option
 * @return string
 */
function getHtmlSelection(array $arr, $keySelected, array $option)
{
    $html = '<select ';
    foreach ($option as $key => $value) {
        $html .= $key . '="' . $value . '"';
    }
    $html .= '>';
    if (is_array($keySelected)) {
        foreach ($arr as $key => $value) {
            $html .= '<option ' . (in_array($key, $keySelected) ? 'selected' : '') . ' value="' . $key . '">' . $value . '</option>';
        }
    } else {
        foreach ($arr as $key => $value) {
            $html .= '<option ' . ($key == $keySelected ? 'selected' : '') . ' value="' . $key . '">' . $value . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

/**
 * @param string $roleName
 * @param bool $admin
 * @return bool nếu không có role name thì mặc định là đang check cho class và method hiện tại
 * nếu không có role name thì mặc định là đang check cho class và method hiện tại
 * nếu không có quyền truy cập thì chuyển hướng về trang home
 * biến return để cho biết là có return ra kết quả checkrole hay không,
 * nếu return bằng true thì chỉ trả về kết quả mà không redirect, ngược lại sẽ redirect trang về home
 */
function checkRole($roleName, $admin = false)
{
    //loại bỏ nhưng chức năng không sử dụng
    //bằng cách return false khi gọi role đến chức năng đó
    if ($roleName == 'email_sent_edit') return false;

    if (get_instance()->session->userdata('userLogined')['admin'] == 1) return true;
    if ($admin) return false;
    if (empty($GLOBALS['role'])) {
        $temp = get_instance()->role_model->get(get_instance()->session->userdata('userLogined')['role_id']);
        $temp = json_decode(html_entity_decode($temp['detail']), true);
        $GLOBALS['role'] = $temp;
        foreach ($temp as $item) {
            if (is_array($item)) {
                foreach ($item as $value) {
                    $GLOBALS['role'][$value] = 'on';
                }
            }
        }
    }
    if (isset($GLOBALS['role'][$roleName]) && $GLOBALS['role'][$roleName] == 'on') return true;
    return false;
}

/**
 * @param $dataArr
 * @param $parentId
 * @param $result
 * @param string $space
 */
function sortBlogCategory($dataArr, $parentId, &$result, $space = '')
{
    $data = $dataArr;
    if ($parentId != '0') $space .= '|__';
    foreach ($data as $key => $item) {
        if ($item['parent_id'] == $parentId) {
            $result[$item['id']] = $space . $item['name'];
            unset($data[$key]);
            sortBlogCategory($data, $item['id'], $result, $space);
        }
    }
}

/**
 * @param array $arr
 * @param $begin
 * @param $end
 * @return array
 */
function subArray(array $arr, $begin, $end)
{
    $result = array();
    for ($i = $begin; $i <= $end; $i++) {
        $result[] = $arr[$i];
    }
    return $result;
}

/**
 * @param $s
 * @return mixed|string
 */
function rewrite($s)
{
    $table = array('|'=>'','À' => 'a', 'Á' => 'a', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ă' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Æ' => 'A', 'Ǽ' => 'A', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ă' => 'a', 'ā' => 'a', 'ą' => 'a', 'æ' => 'a', 'ǽ' => 'a', 'Ả' => 'a', 'ả' => 'a', 'Ạ' => 'a', 'ạ' => 'a', 'Ắ' => 'A', 'Ằ' => 'A', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'Ẳ' => 'A', 'Ẵ' => 'A', 'ẵ' => 'a', 'Ặ' => 'A', 'ặ' => 'a', 'Ấ' => 'A', 'ấ' => 'a', 'Ầ' => 'A', 'ầ' => 'a', 'Ẩ' => 'A', 'ẩ' => 'a', 'Ẫ' => 'A', 'ẫ' => 'a', 'Ậ' => 'A', 'ậ' => 'a', 'Þ' => 'B', 'þ' => 'b', 'ß' => 'Ss', 'Ç' => 'C', 'Č' => 'C', 'Ć' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'ç' => 'c', 'č' => 'c', 'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c', 'Đ' => 'd', 'Ď' => 'd', 'đ' => 'd', 'ď' => 'd', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ĕ' => 'E', 'Ē' => 'E', 'Ę' => 'E', 'Ė' => 'E', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ĕ' => 'e', 'ē' => 'e', 'ę' => 'e', 'ė' => 'e', 'Ĝ' => 'G', 'Ğ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'Ĥ' => 'H', 'Ħ' => 'H', 'ĥ' => 'h', 'ħ' => 'h', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'İ' => 'I', 'Ĩ' => 'I', 'Ī' => 'I', 'Ĭ' => 'I', 'Į' => 'I', 'Ỉ' => 'I', 'Ị' => 'I', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'į' => 'i', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i', 'ı' => 'i', 'ỉ' => 'i', 'ị' => 'i', 'Ĵ' => 'J', 'ĵ' => 'j', 'Ķ' => 'K', 'ķ' => 'k', 'ĸ' => 'k', 'Ĺ' => 'L', 'Ļ' => 'L', 'Ľ' => 'L', 'Ŀ' => 'L', 'Ł' => 'L', 'ĺ' => 'l', 'ļ' => 'l', 'ľ' => 'l', 'ŀ' => 'l', 'ł' => 'l', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N', 'Ņ' => 'N', 'Ŋ' => 'N', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŋ' => 'n', 'ŉ' => 'n', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ŏ' => 'O', 'Ő' => 'O', 'Œ' => 'O', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o', 'œ' => 'o', 'ð' => 'o', 'Ŕ' => 'R', 'Ř' => 'R', 'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'Š' => 'S', 'Ŝ' => 'S', 'Ś' => 'S', 'Ş' => 'S', 'š' => 's', 'ŝ' => 's', 'ś' => 's', 'ş' => 's', 'Ŧ' => 'T', 'Ţ' => 'T', 'Ť' => 'T', 'ŧ' => 't', 'ţ' => 't', 'ť' => 't', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ũ' => 'U', 'Ū' => 'U', 'Ŭ' => 'U', 'Ů' => 'U', 'Ű' => 'U', 'Ų' => 'U', 'Ữ' => 'U', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ū' => 'u', 'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u', 'ų' => 'u', 'ữ' => 'u', 'Ŵ' => 'W', 'Ẁ' => 'W', 'Ẃ' => 'W', 'Ẅ' => 'W', 'ŵ' => 'w', 'ẁ' => 'w', 'ẃ' => 'w', 'ẅ' => 'w', 'Ý' => 'Y', 'Ÿ' => 'Y', 'Ŷ' => 'Y', 'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y', 'Ž' => 'Z', 'Ź' => 'Z', 'Ż' => 'Z', 'ž' => 'z', 'ź' => 'z', 'ż' => 'z', ' ' => '-', ',' => '', '.' => '', '"' => '', '“' => '', '”' => '', '‘' => "", '’' => "", '•' => '', '…' => '', '—' => '-', '–' => '-', '¿' => '', '¡' => '', '°' => '', '¼' => '', '½' => '', '¾' => '', '⅓' => '', '⅔' => '', '⅛' => '', '⅜' => '', '⅝' => '', '⅞' => '', '÷' => '', '×' => '', '±' => '', '√' => '', '∞' => '', '≈' => '', '≠' => '', '≡' => '', '≤' => '', '≥' => '', '←' => '', '→' => '', '↑' => '', '↓' => '', '↔' => '', '↕' => '', '℅' => '', '℮' => '', 'Ω' => '', '♀' => '', '♂' => '', '©' => '', '®' => '', '™' => '', '%' => '', ':' => '', '/' => '', '?' => '', 'Ỏ' => 'O', 'Ọ' => 'O', 'ỏ' => 'o', 'ọ' => 'o', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'Ủ' => 'U', 'Ụ' => 'U', 'ủ' => 'u', 'ụ' => 'u', 'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ự' => 'U', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ự' => 'u', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', ';' => '-', "'" => '', '[' => '', ']' => ''
    );
    $string = strtr($s, $table);
    $string = preg_replace("/[^\x9\xA\xD\x20-\x7F]/u", "", $string);
    $string = strtolower($string);
    $string = str_replace("--", '', $string);
    return $string;
}

function checkExistRouter($name, $except = array())
{
    $CI = get_instance();
    $sql = "SELECT * FROM router WHERE name='{$name}'";
    $result = $CI->db->query($sql)->result_array();
    if (count($result) == 1) {
        if(in_array($result[0]['target_id'],$except)) return false;
        return true;
    }
    return false;
}

/**
 * @param $str
 * @param int $startPos
 * @param int $maxLength
 * @return string
 */
function getExcerpt($str, $startPos = 0, $maxLength = 100)
{
    if (strlen(strip_tags($str)) > $maxLength) {
        $excerpt = substr(strip_tags($str), $startPos, $maxLength - 3);
        $lastSpace = strrpos($excerpt, ' ');
        $excerpt = substr($excerpt, 0, $lastSpace);
        $excerpt .= '...';
    } else {
        $excerpt = strip_tags($str);
    }

    return $excerpt;
}