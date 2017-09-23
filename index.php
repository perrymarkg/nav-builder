<?php

require 'vendor/autoload.php';

use prymag\nav_builder\NavBuilder;

?>
<html>
<head>
    <style type="text/css">
        * {
            font-family: "Trebuchet MS", sans-serif;
            margin:0;
            padding:0;
            box-sizing:border-box;
            -webkit-box-sizing:border-box;
            -moz-box-sizing:border-box;
        }
        body {
            background:#95a5a6;
        }        
        .nav-menu,
        .nav-menu ul {
            list-style-type:none;
            margin:0;
            padding:0;
        }
        .nav-menu > li {
            display:inline-block;
            border:1px solid #85E2FF;
            border-right:none;
        }
        .nav-menu > li:last-child {
            border-right:1px solid #85E2FF;
        }
        .nav-menu li {
            position:relative;
        }
        .nav-menu li:hover > a {
            background:#2c3e50;
            color:#85E2FF;
        }
        .nav-menu li a {
            display:block;
            padding:15px 30px;
            border:none;
            background:#08AAC7;
            color:#ffffff;
            text-transform:uppercase;
            text-decoration:none;
        }
        .nav-menu li ul {
            display:none;
            position:absolute;
            width:200px;
            text-align:left;
            -webkit-box-shadow: 0px 5px 35px -9px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 5px 35px -9px rgba(0,0,0,0.75);
            box-shadow: 0px 5px 35px -9px rgba(0,0,0,0.75);
        }
        .nav-menu li:hover > ul {
            display:block;
            z-index:10;
        }
        .nav-menu li ul.level-2 ul {
            top:0;
            left:98%;
        }

        .menu-1 {
            text-align:center;
            border-bottom:1px solid #bbb;
            padding:30px;
        }
        .menu-1 ul {
            display:inline-block;
            
            margin:0 auto;
        }
    </style>
</head>

<body>
<?php
// Associative array to Menu
$nav_array1 = array(
    array('id' => '1', 'class' => 'classname', 'name' => 'Nav One', 'link' => 'http://link.com',
        'children' => array( 
            array('id' => '1.1', 'class' => 'classname', 'name' => 'Nav One Child', 'link' => 'http://link.com'),
            array('id' => '1.2', 'class' => 'classname', 'name' => 'Nav One Child 2', 'link' => 'http://link.com',
                'children' => array(
                    array( 'id' => '1.2.1', 'class' => 'classname', 'name' => 'Nav 1.2.1', 'link' => 'http://link.com'  ),
                    array( 'id' => '1.2.2', 'class' => 'classname', 'name' => 'Nav 1.2.2', 'link' => 'http://link.com',
                        'children' => array(
                            array('id' => '1.2.2.1', 'class' => 'classname', 'name' => 'Nav 1.2.2,1', 'link' => 'http://link.com'),
                            array('id' => '1.2.2.2', 'class' => 'classname', 'name' => 'Nav 1.2.2.1', 'link' => 'http://link.com')
                        )
                    ),
                    array( 'id' => '1.2.3', 'class' => 'classname', 'name' => 'Nav 1.2.3', 'link' => 'http://link.com'  )
                )
            ),
            array('id' => '1.3', 'class' => 'classname', 'name' => 'Nav One Child 3', 'link' => 'http://link.com'),
        )
    ),
    array('id' => '2', 'class' => 'classname', 'name' => 'Nav Two', 'link' => 'http://link.com')
);

$nav = new NavBuilder( $nav_array1, array( 'class' => 'nav-menu' ) );
?>

<div class="menu-1">
<?php $nav->display(); ?>
</div>

<?php 
    $flat_array = array(
        array('id' => '1', 'parent_id' => '6', 'class' => 'classname', 'name' => 'Category 1'),
        array('id' => '2', 'parent_id' => '1', 'class' => 'classname', 'name' => 'Category 2'),
        array('id' => '3', 'parent_id' => '5', 'class' => 'classname', 'name' => 'Category 3'),
        array('id' => '4', 'parent_id' => '0', 'class' => 'classname', 'name' => 'Category 4'),
        array('id' => '5', 'parent_id' => '0', 'class' => 'classname', 'name' => 'Category 5'),
        array('id' => '6', 'parent_id' => '8', 'class' => 'classname', 'name' => 'Category 6'),
        array('id' => '7', 'parent_id' => '6', 'class' => 'classname', 'name' => 'Category 7'),
        array('id' => '8', 'parent_id' => '5', 'class' => 'classname', 'name' => 'Category 8'),
        array('id' => '9', 'parent_id' => '0', 'class' => 'classname', 'name' => 'Category 9'),
    );
    $nav_flat = new NavBuilder( $flat_array, array('class' => 'nav-menu'), true );
?>
    <div class="menu-1">
    <?php $nav_flat->display(); ?>
    </div>
</body>
</html>