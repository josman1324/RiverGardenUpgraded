<?php
// Definimos el título de esta página
$page_title = 'Haz tu Reserva - River Garden Hotel';
$header_style = 'solid'; // <-- Menú sólido
// Incluimos la cabecera (Menú)
include 'includes/header.php';
?>

<main>
  <div class="reservation-form">
    <h2>Reserva tu habitación</h2>
    
    <form id="reservaForm" action="guardar_reserva_v2.php" method="POST" class="form-container">
      
      <div class="form-group">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" required>
        <div id="errorNombre" class="error-message">El nombre solo debe contener letras y espacios.</div>
      </div>

      <div class="form-group">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <div id="errorEmail" class="error-message">Por favor, introduce un correo válido.</div>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono (Requerido):</label>
        <input type="tel" id="telefono" name="telefono" required>
        <div id="errorTelefono" class="error-message">Por favor, introduce un número de teléfono.</div>
      </div>

      <div class="form-group">
        <label for="fecha_entrada">Fecha de entrada:</label>
        <input type="date" id="fecha_entrada" name="fecha_entrada" required>
        <div id="errorFechaEntrada" class="error-message">La fecha de entrada no puede ser en el pasado.</div>
      </div>

      <div class="form-group">
        <label for="fecha_salida">Fecha de salida:</label>
        <input type="date" id="fecha_salida" name="fecha_salida" required>
        <div id="errorFechaSalida" class="error-message">La fecha de salida debe ser posterior a la de entrada.</div>
      </div>

      <div class="form-group">
        <label for="habitacion">Tipo de habitación:</label>
        <select id="habitacion" name="habitacion" required>
          <option value="">-- Selecciona una opción --</option>
          <option value="1">Individual (150.000 COP/noche)</option>
          <option value="2">Pareja (250.000 COP/noche)</option>
          <option value="3">Triple (350.000 COP/noche)</option>
          <option value="4">Familiar (450.000 COP/noche)</option>
        </select>
        <div id="errorHabitacion" class="error-message">Debes seleccionar un tipo de habitación.</div>
      </div>

      <button type="submit" class="btn-submit">Continuar al Pago</button>
    </form>
  </div>
</main>
<script>
    const form = document.getElementById('reservaForm');
    
    const showError = (field, errorId, message, isValid) => {
        const errorDiv = document.getElementById(errorId);
        if (!isValid) {
            field.classList.add('invalid');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        } else {
            field.classList.remove('invalid');
            errorDiv.style.display = 'none';
        }
    };

    const validateName = () => {
        const nombre = document.getElementById('nombre');
        const regex = /^[A-Za-z\s]+$/;
        const isValid = regex.test(nombre.value) && nombre.value.trim().length > 2;
        showError(nombre, 'errorNombre', 'El nombre solo debe contener letras y espacios (mín. 3).', isValid);
        return isValid;
    };

    const validateEmail = () => {
        const email = document.getElementById('email');
        const regex = /^\S+@\S+\.\S+$/;
        const isValid = regex.test(email.value);
        showError(email, 'errorEmail', 'Por favor, introduce un correo válido.', isValid);
        return isValid;
    };

    const validateRequired = (fieldId, errorId, message) => {
        const field = document.getElementById(fieldId);
        const isValid = field.value !== '';
        showError(field, errorId, message, isValid);
        return isValid;
    };

    const validateDates = () => {
        const fechaEntrada = document.getElementById('fecha_entrada');
        const fechaSalida = document.getElementById('fecha_salida');
        const today = new Date().toISOString().split('T')[0];

        let isValidEntrada = fechaEntrada.value >= today;
        showError(fechaEntrada, 'errorFechaEntrada', 'La fecha de entrada no puede ser en el pasado.', isValidEntrada);

        let isValidSalida = fechaSalida.value > fechaEntrada.value;
        showError(fechaSalida, 'errorFechaSalida', 'La fecha de salida debe ser posterior a la de entrada.', isValidSalida);

        return isValidEntrada && isValidSalida;
    };

    document.getElementById('nombre').addEventListener('input', validateName);
    document.getElementById('email').addEventListener('input', validateEmail);

    form.addEventListener('submit', function (e) {
        const isNameValid = validateName();
        const isEmailValid = validateEmail();
        const isPhoneValid = validateRequired('telefono', 'errorTelefono', 'El teléfono es obligatorio.');
        const isRoomValid = validateRequired('habitacion', 'errorHabitacion', 'Debes seleccionar una habitación.');
        const areDatesValid = validateDates();

        if (!isNameValid || !isEmailValid || !isPhoneValid || !isRoomValid || !areDatesValid) {
            e.preventDefault(); 
            alert('Por favor, corrige los errores en el formulario.');
        }
    });
</script>

<?php
// Incluimos el pie de página
include 'includes/footer.php';
?>