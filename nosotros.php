<?php 
  require './includes/app.php';
  $inicio = true;
  incluirTemplate('header');
?>

  <main class="contenedor seccion">
    <h1>Conoce Sobre Nosotros</h1>
    <div class="contenido-nosotros">
      <div class="imagen">
        <picture>
          <source srcset="./build/img/nosotros.webp" type="image/webp">
          <source srcset="./build/img/nosotros.jpg" type="image/jpg">
          <img src="./build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
        </picture>
      </div>

      <div class="texto-nosotros">
        <blockquote>25 Años de experiencia</blockquote>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus laborum porro, pariatur dicta, eius illum architecto asperiores voluptatem nemo consequuntur unde ratione! Optio odio officiis molestias, quasi consectetur esse non.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis itaque quibusdam non ipsa consectetur inventore, reiciendis ipsum nostrum iste dicta sunt nihil architecto alias minus sint tempora magnam! Quibusdam, velit. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro deleniti tenetur nostrum itaque non ea sapiente distinctio aliquam eum animi, tempore aut ullam et ad deserunt quos illo, dolore reiciendis.</p>
      </div>
    </div>
  </main>

  <section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <div class="iconos-nosotros">
      <div class="icono">
        <img src="./build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
        <h3>Seguridad</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus asperiores dignissimos officia sint fugiat dolor corrupti. Assumenda, dolorem sequi.</p>
      </div>
      <div class="icono">
        <img src="./build/img/icono2.svg" alt="Icono Precio" loading="lazy">
        <h3>Precio</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus asperiores dignissimos officia sint fugiat dolor corrupti. Assumenda, dolorem sequi.</p>
      </div>
      <div class="icono">
        <img src="./build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
        <h3>Tiempo</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus asperiores dignissimos officia sint fugiat dolor corrupti. Assumenda, dolorem sequi.</p>
      </div>
    </div>
  </section>

<?php 
  incluirTemplate('footer');
?>