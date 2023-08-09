<?php 
  require './includes/app.php';
  $inicio = true;
  incluirTemplate('header');
?>

  <main class="contenedor seccion contenido-centrado">
    <h1>Guía para la decoración de tu hogar</h1>
    <picture>
        <source srcset="./build/img/destacada2.webp" type="image/webp">
        <source srcset="./build/img/destacada2.jpg" type="image/jpeg">
        <img src="./build/img/destacada2.jpg" alt="Imagen Propiedad" loading="lazy">
    </picture>
    
    <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>

    <div class="resumen-propiedad">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam harum repellendus, numquam, ex totam nemo consequatur vitae quae pariatur voluptatum quis. Nemo facilis hic dicta sint non maxime vero necessitatibus?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam modi, minus fuga reprehenderit aspernatur nobis deserunt in atque! Dolorem obcaecati autem laborum magnam in sunt explicabo odio quisquam, consequuntur recusandae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis quibusdam corrupti cum eius quisquam aut cupiditate enim debitis, distinctio quos sequi numquam labore quo nesciunt laudantium necessitatibus? Magni, ipsam laboriosam!</p>
    </div>
  </main>

<?php 
  incluirTemplate('footer');
?>