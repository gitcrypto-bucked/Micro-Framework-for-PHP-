<!DOCTYPE HTML>
<?php

use \App\Controller\Sessoes;
use \App\Views\Render;

function getMounth()
{
    switch(date("M"))
    {
        case 'Jan':
            return "Janeiro";
        break;
        case 'Feb':
            return "Fevereiro";
        break;
        case 'Mar':
            return "Março";
        break;
        case 'Apr':
            return "Abril";
        break;
        case 'May':
            return "Maio";
        break;
        case 'Jun':
            return "Junho";
        break;
        case 'Jul':
            return "Julho";
        break;
        case "Aug":
            return "Agosto";
        break;
        case "Set":
            return "Setembro";
        break;
        case "Oct":
            return "Outrubro";
        break;
        case "Nov":
            return "Novembro";
        break;
        case "Dec":
            return "December";
        break;
    }
}

function saudacao()
{
    date_default_timezone_set('America/Sao_Paulo');

    $hora = date('H');
    if($hora <12 && $hora>=6)
    {
        return "Bom Dia";
    }

    if($hora >=12 && $hora<18)
    {
        return "Boa Tarde";
    }

    if($hora >=18 && $hora <=23)
    {
        return "Boa Noite";
    }
    if($hora <6 && $hora>=0) 
    {
        return "Boa Madrugada";
    }
}


if(isset($_SESSION['inicio']) && isset($_SESSION['fim']))
{
    if(strtotime($_SESSION['fim']) <= strtotime(date('H:i')))
    {
        $sessao = new Sessoes();
        $sessao-> destroySession($_SESSION['uid']);
        $renderer = new Render();
        $renderer->redirect('login','Sua sessão expirou para continuar faça o login novamente.','',1);
        unset($renderer);
        unset($sessao);
    }
}

?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
		<link rel="stylesheet" href="<?=$_SERVER['assets'];?>/css/main.css" />
        <script>
            const params  = new URLSearchParams(window.location.search);
            const search = params.get('query');
            if(search!='')
            {

            }

            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }

        </script>
        <style>
                            
            .active {
                background-color: #04AA6D;
                color: white;
            }

            .topnav .icon {
                display: none;
            }

            .dropdown {
                float: left;
                overflow: hidden;
            }

            .dropdown .dropbtn {
                font-size: 17px;    
                border: none;
                outline: none;
                color: white;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
            }

            .dropdown-content 
            {  
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .topnav a:hover, .dropdown:hover .dropbtn {
            }

            .dropdown-content a:hover {
                background-color: #ddd;
                color: black;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

        </style>
	</head>
	<body class="is-preload" data-target=".site-navbar-target"
				oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. ';
				return true;" onselectstart="return false" >

    <!-- Wrapper -->
        <div id="wrapper">
            <!-- Header -->
            <header id="header">
                <h1><a href="./"><img src='<?=$_SERVER['assets'];?>/icon/logo.png' alt='' style='width:155px;'></a></h1>
                <nav class="links">
                    <?php 
                        if(!isset($_SESSION['uuid']) || $_SESSION['uuid']=='' && !isset($_SESSION['ativa']))
                        {
                            echo "<ul>
                                    <li><a href=".$_SERVER['url'].">Home</a></li>
                                    <li><a href=".$_SERVER['url']."login>Login</a></li>
                                    </ul>";
                        } 
                        if(isset($_SESSION['uuid']) && $_SESSION['uuid']!='' && isset($_SESSION['ativa']))
                        {
                            $flags = unserialize($_SESSION['flags']);
                            echo "<ul>
                                    <li><a href=".$_SERVER['url']."dashboard>Home</a></li>";
                            if(boolval($flags["flag_clientes"])==true)
                            {
                                echo '<li>
                                        <div class="dropdown">
                                            <a class="dropbtn">Clientes 
                                            <i class="fa fa-caret-down"></i>
                                            </a>
                                            <div class="dropdown-content">
                                            <a href="'.$_SERVER['url'].'">Link 1</a>
                                            <a href="'.$_SERVER['url'].'">Link 2</a>
                                            <a href="'.$_SERVER['url'].'">Link 3</a>
                                            </div>
                                        </div>
                                    </li>';
                            }
                            if(boolval($flags["flag_produtos"])==true)
                            {
                                echo '<li>
                                            <div class="dropdown">
                                            <a class="dropbtn">Produtos 
                                            <i class="fa fa-caret-down"></i>
                                            </a>
                                            <div class="dropdown-content">
                                            <a href="'.$_SERVER['url'].'">Lisnk 1</a>
                                            <a href="'.$_SERVER['url'].'">Linsk 2</a>
                                            <a href="'.$_SERVER['url'].'">Lisnk 3</a>
                                            </div>
                                        </div>
                                    </li>';
                            }
                            echo "<li><a href=".$_SERVER['url']."logout>Logout</a></li>
                                    </ul>";
                        } 
                    ?>
                </nav>
                <nav class="main">
                    <ul>
                        <?php
                        if(isset($_SESSION['uuid']) && $_SESSION['uuid']!='' && isset($_SESSION['ativa']))
                        {
                            print "<li style='text-decoration: none;
                                            border-bottom: 0;
                                            overflow: hidden;
                                            position: relative;
                                            text-indent: 4em;
                                            padding-right:14px'>".(saudacao()).", ".$_SESSION['name']."</li>";
                        
                        echo '<li class="search">
                            <a class="fa-search" href="#search">Search</a>
                            <form id="search" method="get" action="#">
                                <input type="text" name="query" placeholder="Busca" />
                            </form>
                        </li>
                        <li class="menu">
                            <a class="fa-bars" href="#menu">Menu</a>
                        </li>';
                    }
                    ?>
                    </ul>
                </nav>
            </header>

					