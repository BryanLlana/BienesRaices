<?php 
  require './includes/app.php';

  //* BASE DE DATOS
  $db = conectarDB();

  $limite = 3;
  $queryObtenerPropiedades = "SELECT * FROM propiedades LIMIT $limite";
  $resultadoPropiedades = mysqli_query($db, $queryObtenerPropiedades);

  //* IMPLEMENTAR PLANTILLA
  $inicio = true;
  incluirTemplate('header', $inicio); 
?>

  <main class="contenedor seccion">
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
  </main>

  <section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <div class="contenedor-anuncios">
      <?php while($propiedad = mysqli_fetch_assoc($resultadoPropiedades)) { ?>
        <div class="anuncio">
          <img src="/bienesraices/imagenes/<?php echo $propiedad['imagen'] ?>" alt="Imagen <?php echo $propiedad['nombre'] ?>" loading="lazy">
          <div class="contenido-anuncio">
            <h3><?php echo $propiedad['nombre'] ?></h3>
            <p><?php echo $propiedad['descripcion'] ?></p>
            <p class="precio">$<?php echo $propiedad['precio'] ?></p>
  
            <ul class="iconos-caracteristicas">
              <li>
                <img src="./build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                <p><?php echo $propiedad['wc'] ?></p>
              </li>
              <li>
                <img src="./build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy">
                <p><?php echo $propiedad['estacionamiento'] ?></p>
              </li>
              <li>
                <img src="./build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
                <p><?php echo $propiedad['habitaciones'] ?></p>
              </li>
            </ul>
  
            <a href="./anuncio.php?id=<?php echo $propiedad['id'] ?>" class="btn-amarillo-block">Ver Propiedad</a>
          </div>
        </div>
      <?php } ?>
    </div>

    <div class="alinear-derecha">
      <a href="./anuncios.html" class="btn-verde">Ver Todas</a>
    </div>
  </section>

  <section class="imagen-contacto">
    <h2>Encuentra la Casa de tus Sueños</h2>
    <p>Llena el formulario de contacto y un asesor de pondrá en contacto contigo a la brevedad</p>
    <a href="./contacto.html" class="btn-amarillo">Contáctanos</a>
  </section>

  <div class="contenedor seccion seccion-inferior">
    <section class="blog">
      <h3>Nuestro Blog</h3>

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
    </section>

    <section class="testimoniales">
      <h3>Testimoniales</h3>

      <div class="testimonial">
        <blockquote>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea distinctio aperiam, veniam, fuga voluptate sapiente.
        </blockquote>
        <p>- Bryan Tito Llana</p>
      </div>
    </section>
  </div>

<?php 
  incluirTemplate('footer');
?>