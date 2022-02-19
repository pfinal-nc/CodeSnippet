<?php
/**
 * @author pfinal南丞
 * @date 2021年06月21日 上午11:08
 */

function downImage($url, $target_dir = null)
{
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }
    if (!$target_dir) {
        $target_dir = './download';
    }

    $root_url = pathinfo($url);

    $html = file_get_contents($url);            //主要
    preg_match_all('/<img[^>]*src="([^"]*)"[^>]*>/i', $html, $matchs);   //主要

    $images = $matchs[1];

    foreach ($images as $img) {
        $img_url = parse_url($img);
        if (!array_key_exists('host', $img_url)) {
            $img_url = $root_url['dirname'] . DIRECTORY_SEPARATOR . $img;
        } else {
            $img_url = $img;
        }

        $img_path  = array_key_exists('path', $img_url) ? $img_url['path'] : $img;
        $save      = $target_dir . DIRECTORY_SEPARATOR . $img_path;
        $save_path = pathinfo($save);

        if (!is_dir($save_path['dirname'])) {
            mkdir($save_path['dirname'], 0777, true);
        }

        file_put_contents($save, file_get_contents($img_url));   //主要
    }

}