document.addEventListener("DOMContentLoaded", () => {
  // 1. SELECCIONAR LOS ELEMENTOS DE LA INTERFAZ
  const modalVenta = document.querySelector(".sale-modal");
  const botonCerrar = document.querySelector(".btn-cerrar");
  const botonesEditar = document.querySelectorAll(".btn-editar");

  // Elementos internos de la ventana flotante para simular la interactividad
  const inputProductoId = document.querySelector(
    '.sale-modal input[type="text"]',
  );
  const selectTalla = document.querySelector(".sale-modal select");
  const inputCantidad = document.querySelector(
    '.sale-modal input[type="number"]',
  );
  const stockPreview = document.querySelector(".stock-preview");

  // Variable para guardar el stock inicial del producto seleccionado
  let stockActualProducto = 45;

  // ==========================================
  // 2. INTERACCIÓN: ABRIR LA VENTANA AL HACER CLIC EN EL LÁPIZ
  // ==========================================
  botonesEditar.forEach((boton) => {
    boton.addEventListener("click", (e) => {
      // Buscamos los datos de la fila de la tabla de forma automática
      const fila =
        e.target.closest("tr") ||
        e.target.closest(".product-management table tr");

      // Abrimos la ventana añadiendo la clase 'show' que creamos en CSS
      modalVenta.classList.add("show");

      // [Opcional] Esto rellena automáticamente el formulario con los datos de tu imagen
      if (inputProductoId)
        inputProductoId.value = "Jogger Deportivo Zyrox 1000169559";
      if (selectTalla) selectTalla.value = "M";
      if (inputCantidad) inputCantidad.value = "3";

      // Calculamos el stock inicial reflejado en tu imagen (45 - 3 = 42)
      actualizarCalculoStock();
    });
  });

  // ==========================================
  // 3. INTERACCIÓN: CERRAR LA VENTANA CON LA "X"
  // ==========================================
  if (botonCerrar) {
    botonCerrar.addEventListener("click", () => {
      modalVenta.classList.remove("show"); // Quita la clase 'show' y se oculta
    });
  }

  // ==========================================
  // 4. INTERACCIÓN: CÁLCULO DE STOCK EN TIEMPO REAL
  // ==========================================
  function actualizarCalculoStock() {
    if (inputCantidad && stockPreview) {
      const cantidadAVender = parseInt(inputCantidad.value) || 0;

      // Simulamos la resta del stock
      const stockFinal = stockActualProducto - cantidadAVender;

      // Si la cantidad supera al stock, lo limitamos o avisamos
      if (stockFinal < 0) {
        stockPreview.textContent = "Stock insuficiente";
        stockPreview.style.color = "var(--accent-red)";
      } else {
        stockPreview.textContent = `Stock Actualizado: ${stockFinal}`;
        stockPreview.style.color = "var(--accent-blue)";
      }
    }
  }

  // Escucha cada vez que el usuario cambie la cantidad en la casilla para recalcular
  if (inputCantidad) {
    inputCantidad.addEventListener("input", actualizarCalculoStock);
  }

  // Cerrar también si se presiona la tecla Escape (ESC)
  window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      modalVenta.classList.remove("show");
    }
  });
});
