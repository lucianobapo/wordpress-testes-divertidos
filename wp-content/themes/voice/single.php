<?php get_header(); ?>

  <style type="text/css">
    .pai-ads-top-r{ margin: auto; max-width: 1140px; }
    .ads-top-r{ max-width: 730px; margin-left: 40px; margin-top: 20px;}
  </style>
  <div class="pai-ads-top-r">
    <div class="ads-top-r">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Sidebar-TD-Responsivo -->
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-1364233972166119"
           data-ad-slot="7193927588"
           data-ad-format="auto"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
  </div>

<div id="content" class="container site-content">

	<?php global $vce_sidebar_opts; ?>
	<?php if ( $vce_sidebar_opts['use_sidebar'] == 'left' ) { get_sidebar(); } ?>
	
	<div id="primary" class="vce-main-content">

		<main id="main" class="main-box main-box-single">

		<?php while ( have_posts() ) : the_post(); ?>

		<h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1>

      <div class="conteudo-single">
        <?php the_content(); ?>
      </div>

         <?php
         $imagem = array(); // Criamos um array com o nome das imagens.
         $imagem[1] = "howto1"; // Recheamos este array
         $imagem[2] = "howto3";
         $imagem[3] = "howto4";
         $imagem[4] = "howto5";
         $imagem[5] = "howto6";
         $imagem[6] = "howto7";
         $imagem[7] = "howto8";
         $contador = count($imagem); // Criamos uma variavel para contar (count();) os dados que estão dentro do array.
         $aleatorio = rand(1,$contador); // Esta variável irá gerar um número aleatório (rand();), partindo do 1 até o número de dados que estão dentro do array..

         $values = get_post_custom_values("$imagem[$aleatorio]");
         $values2 = get_post_custom_values("howto2");
         $size = get_post_custom_values("howto9");
         $position = get_post_custom_values("howto10");
         $x = get_post_custom_values("howto11");
         $y = get_post_custom_values("howto12");
         $namesize = get_post_custom_values("howto13");
         $namex = get_post_custom_values("howto14");
         $namey = get_post_custom_values("howto15");
         $namecolor = get_post_custom_values("howto16");

         $img1 = "http://mix.testesdivertidos.com/file?id=";
         $img2 = "&file=".$values[0];
         $md5 = array('file' => $values[0]);
         if (!empty($namesize[0])) {
             $img2 = $img2."&namesize=".$namesize[0];
             $md5['namesize'] = $namesize[0];
         }
         if (!empty($namecolor[0])) {
             $img2 = $img2."&namecolor=".$namecolor[0];
             $md5['namecolor'] = $namecolor[0];
         }
         if (!empty($namex[0])) {
             $img2 = $img2."&namex=".$namex[0];
             $md5['namex'] = $namex[0];
         }
         if (!empty($namey[0])) {
             $img2 = $img2."&namey=".$namey[0];
             $md5['namey'] = $namey[0];
         }
         if (!empty($position[0])) {
             $img2 = $img2."&position=".$position[0];
             $md5['position'] = $position[0];
         }
         if (!empty($size[0])) {
             $img2 = $img2."&size=".$size[0];
             $md5['size'] = $size[0];
         }
         if (!empty($x[0])) {
             $img2 = $img2."&x=".$x[0];
             $md5['x'] = $x[0];
         }
         if (!empty($y[0])) {
             $img2 = $img2."&y=".$y[0];
             $md5['y'] = $y[0];
         }
         $key = md5(serialize($md5));
         $imageAws1 = "https://s3-sa-east-1.amazonaws.com/testes-divertidos/img-mixed/".str_replace(['.',':','/'],'',substr($md5['file'],0,-4));
         $imageAws2 = substr($md5['file'],-4);
         $page1 = "http://mix.testesdivertidos.com/pageCached/";
         $page2 = "/".$key;
         $page3 = "?post=".get_the_ID();
//         $page3 = "?post=".get_the_ID().'&post_name='.str_replace('/','',$_SERVER['REQUEST_URI']);
         ?>

<script>
    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=1065386780209103";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

  // Isto é chamado com os resultados a partir de FB.getLoginStatus ().
  var imageResolved;
  var urlResolved;
  var pageResolved;
    console.log('Key:');
    console.log('<?php echo $key; ?>');
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);

    // O objeto de resposta é retornado com um campo de status que permite que o
    // App saber o status de login atual da pessoa.
    // A documentação completa sobre o objeto de resposta pode ser encontrada na documentação
    // Para FB.getLoginStatus ().
//        document.getElementById('status').innerHTML = '<?php //echo '<img src='.$values2[0].'>'; ?>//';
//        document.getElementById('shareBtn').style.display = "none";
        if (response.status === 'connected') {
            // Logado em sua aplicação e Facebook.
        //        testAPI(response.authResponse.accessToken);
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me?fields=birthday,email,name,age_range&access_token=' + response.authResponse.accessToken, function(apiResponse) {
                console.log('Successful login for: ' + apiResponse.name);
                document.getElementById('loginBtn').innerHTML = '';
                imageResolved = '<?php echo $imageAws1; ?>'+apiResponse.id+'<?php echo $imageAws2; ?>';
                urlResolved = '<?php echo $img1; ?>'+apiResponse.id+'&name='+apiResponse.name+'<?php echo $img2; ?>';
                pageResolved = '<?php echo $page1; ?>'+apiResponse.id+'<?php echo $page2; ?>'+'/'+apiResponse.name.replace(' ','-')+'<?php echo $page3; ?>';

        //            console.log(pageResolved);
//                document.getElementById('status').innerHTML = '<img src="'+urlResolved+'">';
//                document.getElementById('shareBtn').style.display = "initial";
                document.getElementById('testeBtn').style.display = "initial";
            });
        } else {
            // A pessoa não está logado no Facebook, por isso não temos certeza se
            // Eles são registrados para este aplicativo ou não.
            document.getElementById('status').innerHTML = '<?php echo '<img src='.$values2[0].'>'; ?>';
            document.getElementById('shareBtn').style.display = "none";
            document.getElementById('testeBtn').style.display = "none";
        }
  }


  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  window.fbAsyncInit = function() {
      FB.init({
        appId       : '1065386780209103',
        status      : false,
        cookie      : true,  // enable cookies to allow the server to access the session
        xfbml       : true,  // parse social plugins on this page
        version     : 'v2.6' // use version 2.2
      });

      FB.Event.subscribe('auth.authResponseChange', function(response) {
          statusChangeCallback(response);
      });
  };

    //Função para o botão teste
    function doTest(){
        if (urlResolved!=undefined){
//            document.getElementById('frame').src = urlResolved;
            document.getElementById('status').innerHTML = '<img src="'+urlResolved+'">';
            document.getElementById('shareBtn').style.display = "initial";
        }
    }
    //Função para o botão compartilhar
    function facebookShare(){
        FB.ui({
            method: 'share',
            href: pageResolved,
            picture: imageResolved,
        }, function(response){});

//        FB.ui({
//            method: 'feed',
//            link: pageResolved,
//            picture: imageResolved,
//            caption: 'An example caption',
//        }, function(response){});

//        var url;
//        if (pageResolved==undefined)
//            url = 'https://www.facebook.com/sharer.php?u=<?php //the_permalink() ?>//&picture=<?php //echo $values[0] ?>//';
//        else
//            url = 'https://www.facebook.com/sharer.php?u='+pageResolved+'&picture='+imageResolved;
//        window.open(url,'ventanacompartir', 'toolbar=0, status=0, width=650, height=450');
    }
</script>

<div id="fb-root"></div>

<style type="text/css">
  #status{ margin: 0px 0 0 0px; }
  .fb-login-button{ margin: auto; text-align: center; margin: 0 0 20px 0;}
  .fb-like{ margin-bottom: 0px; padding: 8px; }
  .ads-300-single{ margin: 0px 0 4px 0; }
  .ads-300-single p{ margin: 2px 0 5px 0; }
  .botao-compartilhar{ margin: 0 0 0px 0;}
  .atualizar-pagina input{background: #fff; border:1px solid #ccc; box-shadow: 1px 2px 5px #888888; color: #333;}
  .viewss{font-size: 10px; padding-left: 9px; color: #F0F0F0;}
  .fb-comments{ margin-top: 5px; }
  #testeBtn{ width: 98%; height: 45px; margin: 10px 5px 0px 5px; font-size: 18px; color: white; display: none; background: #5CB85C; border-color:1px solid #4CAE4C; }
  #testeBtn:hover{color: white; background: #449D44; border-color:1px solid #398439;}
</style>
<center>
<!--    <iframe id="frame" name="frame" width="800" height="420" src="--><?php //echo $values2[0]; ?><!--"></iframe>-->

	<div id="status">
        <?php echo '<img src='.$values2[0].'>'; ?>
        <button id="testeBtn" onclick="doTest();"><i class="fa fa-question-circle" aria-hidden="true"></i> Faça o Teste</button>
    </div>

	<div class="fb-like" data-href="https://facebook.com/testesdivertidos"
         data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

	<div class="ads-300-single"> 
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- TD-single-336 -->
      <ins class="adsbygoogle"
           style="display:inline-block;width:336px;height:280px"
           data-ad-client="ca-pub-1364233972166119"
           data-ad-slot="3943495986"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
	</div>

	<div id="loginBtn">
	    <div class="fb-login-button" data-max-rows="1" data-size="xlarge"
	         data-show-faces="false" data-auto-logout-link="false">Entre com Facebook
	    </div>
	</div>

	<div id="shareBtn" class="botao-compartilhar" style="display: none">
		<a href="javascript: void(0);" data-layout="button_count"
           onclick="facebookShare();">
            <img src="http://testesdivertidos.com/compartilhar.png">
		</a>
        <br>
        <div class="atualizar-pagina">
            <input type="button" a href="<?php the_permalink() ?>" value="↻ Refazer teste" onClick="history.go(0)">
        </div>
        <br>
	</div>

</center>

<div class="viewss"><?php echo do_shortcode('[post-views]') ?></div>


		<?php endwhile; ?>

		<?php if(vce_get_option('show_prev_next')) : ?>
			<?php get_template_part('sections/prev-next'); ?>
		<?php endif; ?>

		</main>

		<?php if(vce_get_option('show_related')) : ?>
			<?php get_template_part('sections/related-box'); ?>
		<?php endif; ?>

		<?php if(vce_get_option('show_author_box')) : ?>
			<?php get_template_part('sections/author-box'); ?>
		<?php endif; ?>

<div class="fb-comments" data-href="<?php the_permalink() ?>" data-width="100%" data-numposts="5"></div>
<br><br><br>

	</div>

  

	<?php if ( $vce_sidebar_opts['use_sidebar'] == 'right' ) { get_sidebar(); } ?>

</div>

<?php get_footer(); ?>