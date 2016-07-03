<link href="http://sistemaalicerce.com.br/arquivos-layout-padrao/css/font-awesome.min.css" rel="stylesheet">
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
         $page1 = "http://mix.testesdivertidos.com/pageCached/";
         $page2 = "/".md5(serialize($md5));
         $page3 = "?post=".get_the_ID();
//         $page3 = "?post=".get_the_ID().'&post_name='.str_replace('/','',$_SERVER['REQUEST_URI']);
         ?>

<script>

  // Isto é chamado com os resultados a partir de FB.getLoginStatus ().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // O objeto de resposta é retornado com um campo de status que permite que o
    // App saber o status de login atual da pessoa.
    // A documentação completa sobre o objeto de resposta pode ser encontrada na documentação
    // Para FB.getLoginStatus ().
    if (response.status === 'connected') {
        // Logado em sua aplicação e Facebook.
        testAPI(response.authResponse.accessToken);
    } else if (response.status === 'not_authorized') {
        // A pessoa está logado no Facebook, mas não a sua aplicação.
        document.getElementById('status').innerHTML = '<?php echo '<img src='.$values2[0].'>'; ?>';
        document.getElementById('shareBtn').style.display = "none";
    } else {
        // A pessoa não está logado no Facebook, por isso não temos certeza se
        // Eles são registrados para este aplicativo ou não.
        document.getElementById('status').innerHTML = '<?php echo '<img src='.$values2[0].'>'; ?>';
        document.getElementById('shareBtn').style.display = "none";
    }
  }


  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
      FB.init({
        appId      : '1065386780209103',
          status: true,
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.6' // use version 2.2
      });

      // Now that we've initialized the JavaScript SDK, we call
      // FB.getLoginStatus().  This function gets the state of the
      // person visiting this page and can return one of three states to
      // the callback you provide.  They can be:
      //
      // 1. Logged into your app ('connected')
      // 2. Logged into Facebook, but not your app ('not_authorized')
      // 3. Not logged into Facebook and can't tell if they are logged into
      //    your app or not.
      //
      // These three cases are handled in the callback function.

      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });

      FB.Event.subscribe('auth.authResponseChange', function(response) {
          statusChangeCallback(response);
      });

  };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=1065386780209103";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    var urlResolved=null;
    var pageResolved=null;

  function testAPI(accessToken) {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me?fields=birthday,email,name,age_range&access_token=' + accessToken, function(response) {
            console.log('Successful login for: ' + response.name);
            document.getElementById('loginBtn').innerHTML = '';
            urlResolved = '<?php echo $img1; ?>'+response.id+'&name='+response.name+'<?php echo $img2; ?>';
            pageResolved = '<?php echo $page1; ?>'+response.id+'<?php echo $page2; ?>'+'/'+response.name.replace(' ','-')+'<?php echo $page3; ?>';

            console.log(pageResolved);
            document.getElementById('status').innerHTML = '<img src="'+urlResolved+'">';
            document.getElementById('shareBtn').style.display = "initial";
        });
    }

    //Função para o botão compartilhar
    function facebookShare(){
        var url;
        if (urlResolved==null)
            url = 'https://www.facebook.com/sharer.php?u=<?php the_permalink() ?>&picture=<?php echo $values[0] ?>';
        else url = 'https://www.facebook.com/sharer.php?u='+pageResolved;
//        else url = 'https://www.facebook.com/sharer.php?u=<?php //the_permalink() ?>//&picture='+pageResolved;
//            url = 'https://www.facebook.com/sharer.php?u='+pageResolved+'&picture='+urlResolved;

        window.open(url,'ventanacompartir', 'toolbar=0, status=0, width=650, height=450');
    }
</script>

<!--<div id="teste"></div>-->
<div id="fb-root"></div>
<!--<script>-->
<!--    (function(d, s, id) {-->
<!--  var js, fjs = d.getElementsByTagName(s)[0];-->
<!--  if (d.getElementById(id)) return;-->
<!--  js = d.createElement(s); js.id = id;-->
<!--  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=1584544561792934";-->
<!--  fjs.parentNode.insertBefore(js, fjs);-->
<!--}(document, 'script', 'facebook-jssdk'));-->
<!--</script>-->

<style type="text/css">
  #status{ margin: 0px 0 0 0px; }
  .fb-login-button{ margin: auto; text-align: center; margin: 0 0 20px 0;}
  .fb-like{ margin-bottom: 8px; padding: 8px; }
  .ads-300-single{ margin: 0px 0 20px 0; }
  .ads-300-single p{ margin: 2px 0 5px 0; }
  .botao-compartilhar{ margin: 0 0 0px 0;}
  .atualizar-pagina input{background: #fff; border:1px solid #ccc; box-shadow: 1px 2px 5px #888888; color: #333;}
  .viewss{font-size: 10px; padding-left: 9px; color: #F0F0F0;}
  .fb-comments{ margin-top: 5px; }
</style>
<center>
	<div id="status"></div>

	<div class="fb-like" data-href="https://facebook.com/testesdivertidos" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

	<div class="ads-300-single"> 
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- TestesDivertidos -->
    <ins class="adsbygoogle"
         style="display:inline-block;width:300px;height:250px"
         data-ad-client="ca-pub-1364233972166119"
         data-ad-slot="9706095180"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
	</div>

	<div id="loginBtn">
	    <div class="fb-login-button" data-max-rows="1" data-size="xlarge"
	         data-show-faces="false" data-auto-logout-link="true">Entre com Facebook
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