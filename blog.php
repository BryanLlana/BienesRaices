<?php 
  require './includes/app.php';
  $inicio = true;
  incluirTemplate('header');
?>

  <main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>

    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="./build/img/blog1.webp" type="image/webp">
          <source srcset="./build/img/blog1.jpg" type="image/jpeg">
          <img src="./build/img/blog1.jpg" alt="Entrada Blog">
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="./entrada.php">
          <h4>Terraza en el Techo de tu Casa</h4>
          <p>Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloremque.</p>
        </a>
      </div>
    </article>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="./build/img/blog2.webp" type="image/webp">
          <source srcset="./build/img/blog2.jpg" type="image/jpeg">
          <img src="./build/img/blog2.jpg" alt="Entrada Blog">
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="./entrada.php">
          <h4>Terraza en el Techo de tu Casa</h4>
          <p>Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloremque.</p>
        </a>
      </div>
    </article>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="./build/img/blog3.webp" type="image/webp">
          <source srcset="./build/img/blog3.jpg" type="image/jpeg">
          <img src="./build/img/blog3.jpg" alt="Entrada Blog">
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="./entrada.php">
          <h4>Terraza en el Techo de tu Casa</h4>
          <p>Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloremque.</p>
        </a>
      </div>
    </article>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="./build/img/blog4.webp" type="image/webp">
          <source srcset="./build/img/blog4.jpg" type="image/jpeg">
          <img src="./build/img/blog4.jpg" alt="Entrada Blog">
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="./entrada.php">
          <h4>Terraza en el Techo de tu Casa</h4>
          <p>Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloremque.</p>
        </a>
      </div>
    </article>
  </main>

<?php 
  incluirTemplate('footer');
?>