<?php 
  require './includes/app.php';
  $inicio = true;
  incluirTemplate('header');
?>

  <main class="contenedor seccion contenido-centrado">
    <h1>Contacto</h1>

    <picture>
      <source srcset="./build/img/destacada3.webp" type="image/webp">
      <source srcset="./build/img/destacada3.jpg" type="image/jpeg">
      <img src="./build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
    </picture>

    <h2>Llene el Formulario de Contacto</h2>

    <form class="formulario">
      <fieldset>
        <legend>Información Personal</legend>

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" placeholder="Ejm: Bryan Joseph">

        <label for="email">E-mail</label>
        <input type="email" id="email" placeholder="Ejm: bryan@gmail.com">

        <label for="celular">Celular</label>
        <input type="tel" id="celular" placeholder="Ejm: 123456788">

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje"></textarea>
      </fieldset>

      <fieldset>
        <legend>Información sobre la Propiedad</legend>

        <label for="opciones">Vende o Compra:</label>
        <select id="opciones">
          <option value="" disabled selected>--Seleccione--</option>
          <option value="compra">Compra</option>
          <option value="vende">Vende</option>
        </select>

        <label for="presupuesto">Presupuesto</label>
        <input type="number" id="presupuesto">
      </fieldset>

      <fieldset>
        <legend>Información sobre la Propiedad</legend>

        <p>Como desea ser contactado</p>

        <div class="forma-contacto">
          <label for="contactar-celular">Celular</label>
          <input name="contacto" type="radio" value="celular" id="contactar-celular">

          <label for="contactar-email">E-mail</label>
          <input name="contacto" type="radio" value="email" id="contactar-email">
        </div>

        <p>Si eligió celular, elija la fecha y la hora</p>
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00">
      </fieldset>

      <input type="submit" value="Enviar" class="btn-verde">
    </form>
  </main>

<?php 
  incluirTemplate('footer');
?>