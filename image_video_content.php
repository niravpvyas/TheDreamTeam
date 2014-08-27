<?php
    $page_name = $page_detail = $video_name = $yt_path = $navigation = $and1 = "";
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $and1 = " AND s.id = $id ";
    }
    elseif ($currentFileName == "index.php")
    {
        $and1 = " AND s.page_name = 'Home' ";
    }
    
    if(!isset($_SESSION['frontCustomer']['id']))
    {
        $navigation = " AND s.navigation = 'All-In'";
    }
    
    $selectStaticContent = " SELECT s.page_name, s.page_detail, v.video_name, v.yt_path, v.status AS videoStatus
                            FROM `static` AS `s`
                            LEFT OUTER JOIN `video` AS `v`
                            ON s.id = v.id_static
                            WHERE 1=1 $navigation $and1 LIMIT 1 ";

    $listStaticContent = mysql_query($selectStaticContent);
    if(mysql_num_rows($listStaticContent) > 0)
    {
        while($rowStaticContent = mysql_fetch_object($listStaticContent))
        {
            $page_name = stripslashes($rowStaticContent->page_name);
            $page_detail = stripslashes($rowStaticContent->page_detail);
            if($rowStaticContent->videoStatus == 1)
            {
                $video_name = stripslashes($rowStaticContent->video_name);
                $yt_path = stripslashes($rowStaticContent->yt_path);
            }
        }
    }
    else
    {
        header('Location: index.php');
        exit;
    }
    
?>
