<?php

use \Charts\Graph;

if(!isset($_SESSION['uuid']) || $_SESSION['uuid']=='' && !isset($_SESSION['ativa']))
{
    header('Location: ./');
}

$customers = \Charts\Graph::getCustomerCharts(true);


$products = \Charts\Graph::getProductCharts(true);

?>
<head>
  <meta http-equiv="refresh" content="6800"> 
  <style>
   

    canvas {
        border: 1px dotted lightgray;
        height: 350px;
    }

  </style>
</head>

    <!-- Menu -->
    <section id="menu">

<!-- Search -->
    <section>
        <form class="search" method="get" action="#">
            <input type="text" name="query" placeholder="Search" />
        </form>
    </section>

<!-- Links -->
    <section>
        <ul class="links">
            <li>
                <a href="#">
                    <h3>Lorem ipsum</h3>
                    <p>Feugiat tempus veroeros dolor</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Dolor sit amet</h3>
                    <p>Sed vitae justo condimentum</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Feugiat veroeros</h3>
                    <p>Phasellus sed ultricies mi congue</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Etiam sed consequat</h3>
                    <p>Porta lectus amet ultricies</p>
                </a>
            </li>
        </ul>
    </section>

<!-- Actions -->
    <section>
        <ul class="actions stacked">
            <?php 
                if(!isset($_SESSION['uuid']) || $_SESSION['uuid']=='' && !isset($_SESSION['ativa']))
                {
                    echo '  <li><a href="./login" class="button large fit">Log In</a></li>';
                }
                if(isset($_SESSION['uuid']) && $_SESSION['uuid']!='' && isset($_SESSION['ativa']))
                {
                    echo '  <li><a href="./logout" class="button large fit">Log Out</a></li>';
                }
            ?>
            
        </ul>
    </section>

</section>

<!-- Main -->
<div id="main">

<!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h3><a href="javascript:void(0)">Grafico Clientes</a></h3>
                <p></p>
            </div>
            <div class="meta">
            <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                <a href="javascript:void(0)" class="author">
                    <span class="name">Admin</span>
                    <img src="<?=$_SERVER['assets'];?>img/avatar.jpg" alt="" />
                </a>
            </div>
        </header>
        <a href="javascript:void(0)" class="image featured"><canvas id='customersGraph' ></canvas></a>
        <footer>
        </footer>
    </article>
<!--end-->
<!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h3><a href="javascript:void(0)">Grafico Produtos</a></h3>
                <p></p>
            </div>
            <div class="meta">
            <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                <a href="javascript:void(0)" class="author"><span class="name">Admin</span><img src="<?=$_SERVER['assets'];?>img/avatar.jpg" alt="" /></a>
            </div>
        </header>
        <a href="single.html" class="image featured"><canvas id="productsGraph"></canvas></a>
        <footer>
        </footer>
    </article>

<!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h2><a href="single.html">Euismod et accumsan</a></h2>
                <p>Lorem ipsum dolor amet nullam consequat etiam feugiat</p>
            </div>
            <div class="meta">
            <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                <a href="#" class="author"><span class="name">Jane Doe</span><img src="<?=$_SERVER['assets'];?>img/avatar.jpg" alt="" /></a>
            </div>
        </header>
        <a href="single.html" class="image featured"><img src="<?=$_SERVER['assets'];?>img/pic03.jpg" alt="" /></a>
        <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Cras vehicula tellus eu ligula viverra, ac fringilla turpis suscipit. Quisque vestibulum rhoncus ligula.</p>
        <footer>
            <ul class="actions">
                <li><a href="single.html" class="button large">Continue Reading</a></li>
            </ul>
            <ul class="stats">
                <li><a href="#">General</a></li>
                <li><a href="#" class="icon solid fa-heart">28</a></li>
                <li><a href="#" class="icon solid fa-comment">128</a></li>
            </ul>
        </footer>
    </article>


<!-- Pagination -->
    <!-- <ul class="actions pagination">
        <li><a href="" class="disabled button large previous">Previous Page</a></li>
        <li><a href="#" class="button large next">Next Page</a></li>
    </ul> -->       

</div>

<!-- Sidebar -->
<section id="sidebar">

<!-- Intro -->
    <section id="intro">
        <a href="#" class="logo"><img src="<?=$_SERVER['assets'];?>img/logo.jpg" alt="" /></a>
        <header>
            <h2>Future Imperfect</h2>
            <p>Another fine responsive site template by <a href="http://html5up.net">HTML5 UP</a></p>
        </header>
    </section>

<!-- Mini Posts -->
    <section>
        <div class="mini-posts">

            <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="single.html">Vitae sed condimentum</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                        <a href="#" class="author"><img src="<?=$_SERVER['assets'];?>img/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic04.jpg" alt="" /></a>
                </article>

            <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="single.html">Rutrum neque accumsan</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                        <a href="#" class="author"><img src="<?=$_SERVER['assets'];?>img/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic05.jpg" alt="" /></a>
                </article>

            <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="single.html">Odio congue mattis</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                        <a href="#" class="author"><img src="<?=$_SERVER['assets'];?>img/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic06.jpg" alt="" /></a>
                </article>

            <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="single.html">Enim nisl veroeros</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                        <a href="#" class="author"><img src="<?=$_SERVER['assets'];?>img/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic07.jpg" alt="" /></a>
                </article>

        </div>
    </section>

<!-- Posts List -->
    <section>
        <ul class="posts">
            <li>
                <article>
                    <header>
                        <h3><a href="single.html">Lorem ipsum fermeddtum ut nisl vitae</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic08.jpg" alt="" /></a>
                </article>
            </li>
            <li>
                <article>
                    <header>
                        <h3><a href="single.html">Convallis maximus nisl mattis nunc id lorem</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic09.jpg" alt="" /></a>
                </article>
            </li>
            <li>
                <article>
                    <header>
                        <h3><a href="single.html">Euismod amet placerat vivamus porttitor</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic10.jpg" alt="" /></a>
                </article>
            </li>
            <li>
                <article>
                    <header>
                        <h3><a href="single.html">Magna enim accumsan tortor cursus ultricies</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic11.jpg" alt="" /></a>
                </article>
            </li>
            <li>
                <article>
                    <header>
                        <h3><a href="single.html">Congue ullam csorper lorem ipsum dolor</a></h3>
                        <time class="published" datetime="<?=date("YY-M-d")?>"><?=getMounth();?> <?=date("d")?>, <?=date("Y")?></time>
                    </header>
                    <a href="single.html" class="image"><img src="<?=$_SERVER['assets'];?>img/pic12.jpg" alt="" /></a>
                </article>
            </li>
        </ul>
    </section>

<!-- About
    <section class="blurb">
        <h2>About</h2>
        <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod amet placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at phasellus sed ultricies.</p>
        <ul class="actions">
            <li><a href="#" class="button">Learn More</a></li>
        </ul>
    </section> -->

<!-- Footer
    <section id="footer">
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
            <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
        </ul>
        <p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
    </section> -->

</section>

</div>

<!-- Scripts -->
<script src="<?=$_SERVER['assets'];?>/js/jquery.min.js"></script>
<script src="<?=$_SERVER['assets'];?>/js/browser.min.js"></script>
<script src="<?=$_SERVER['assets'];?>/js/breakpoints.min.js"></script>
<script src="<?=$_SERVER['assets'];?>/js/util.js"></script>
<script src="<?=$_SERVER['assets'];?>/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.12.1/polyfill.min.js" 
 integrity="sha512-uzOpZ74myvXTYZ+mXUsPhDF+/iL/n32GDxdryI2SJronkEyKC8FBFRLiBQ7l7U/PTYebDbgTtbqTa6/vGtU23A=="
 crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script type="text/babel">
    document.title= "Dashboard";

    var dataClientes = 
    {
        labels: [<?=json_encode($customers['dataHoraCadastro']);?>],
        datasets: [{
            label: "Cliente(s)",
            borderColor: "#189AB4",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: <?=json_encode($customers['total']);?>,
        }]
    };

    var optionsClientes = 
    {
        maintainAspectRatio: false,
        scales: {
            y: {
            stacked: true,
            grid: {
                display: false,
                color: "blue"
            }
            },
            x: {
            grid: {
                display: false
            }
            }
        }
    };

    new Chart('customersGraph', {
        type: 'line',
        options: optionsClientes,
        data: dataClientes
    });


    var dataProdutos = 
    {
        labels: [<?=json_encode($products['dataHoraCadastro']);?>],
        datasets: [{
            label: "Produto(s)",
            borderColor: "#FF0080",
            borderWidth: 2,
            hoverBackgroundColor: "#FF0080",
            hoverBorderColor: "#FF0080",
            data: <?=json_encode($products['total']);?>,
        }]
    };

    var optionsProdutos = 
    {
        maintainAspectRatio: false,
        scales: {
            y: {
            stacked: true,
            grid: {
                display: false,
                color: "blue"
            }
            },
            x: {
            grid: {
                display: false
            }
            }
        }
    };

  
    new Chart('productsGraph', 
    {
        type: 'line',
        options: optionsProdutos,
        data: dataProdutos
    });

</script>
</body>
</html>