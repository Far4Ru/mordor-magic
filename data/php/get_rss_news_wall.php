<?php
    if(isset($_POST['page'])){
        $url = $_POST['page'];
        echo getFeedsBy($url);
    }

    function getFeedsBy($url) {

      //$url = "http://news.yandex.ru/index.rss";
        try {
            $content = file_get_contents($url);
            $items = new SimpleXmlElement($content);
            $rss_page = "";
            if(isset($items -> channel -> item)){
                foreach($items -> channel -> item as $item) {
                    $rss_page .= "<p align='center' class='postTitle'><a target='_blank' href = '{$item->link}' title = '$item->title' class='postTitleReference'>".$item->title ."</a></p><div class='postTitleDescription'>" . $item -> description . "</div>";
                    $timestamp = strtotime ($item->pubDate);
                    $rss_page .= "<p class='passedTimeBlock'>".time_is_passed($timestamp)."</p>";
                }
            }
            elseif(isset($items)){
                foreach($items as $item) {
                    if(isset($item->title)){
                        $rss_page .= "<p align='center' class='postTitle'><a target='_blank' href = '{$item->link['href']}' title = '$item->title' class='postTitleReference'>".$item->title ."</a></p>";
                        $link_suffix = explode('=',$item->link['href']);
                        $rss_page .= '<iframe style="padding-left:8%;width:84%;height:62%;" src="https://www.youtube-nocookie.com/embed/'.$link_suffix[1].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        $timestamp = strtotime ($item->updated);
                        $rss_page .= "<p class='passedTimeBlock'>".time_is_passed($timestamp)."</p>";
                    }
                }
            }
        }
        catch (Exception $e) {
            return "Ошибка";
            $e->getMessage();
        }

        return $rss_page;


    }
    function time_is_passed($timestamp){
        $timestamp = time_elapsed(strtotime("now") - $timestamp);
        return $timestamp;

    }
    function time_elapsed($secs){
        /*$bit = array(
            'г' => $secs / 31556926 % 12,
            'н' => $secs / 604800 % 52,
            'д' => $secs / 86400 % 7,
            'ч' => $secs / 3600 % 24,
            'м' => $secs / 60 % 60,
            'с' => $secs % 60
            );*/

        $bit = array(
            'г' => $secs / 31556926 % 12,
            'н' => $secs / 604800 % 52,
            'д' => $secs / 86400 % 7,
            'ч' => $secs / 3600 % 24,
            'м' => $secs / 60 % 60,
            'с' => $secs % 60
            );

        foreach($bit as $k => $v)
            if($v > 0)$ret[] = $v . $k;
        if(count($ret)>2){
            $ret = array($ret[0],$ret[1]);
        }
        return join(' ', $ret);
    }