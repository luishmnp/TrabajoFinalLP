document.addEventListener('DOMContentLoaded', () => {
    const formulario = document.getElementById('formularioCurso');
    
    // Elementos de Código Postal
    const selectCodigoPostal = document.getElementById('selectCodigoPostal');
    const inputOtroCP = document.getElementById('inputOtroCP');

    // Elementos de Empresa
    const selectEmpresa = document.getElementById('selectEmpresa');
    const inputOtraEmpresa = document.getElementById('inputOtraEmpresa');
    const labelEmpresa = document.getElementById('labelEmpresa');

    // Elementos de Cursos
    const selectCursos = document.getElementById('selectCursos');
    const inputOtroCurso = document.getElementById('inputOtroCurso');
    const labelCursos = document.getElementById('labelCursos');

    // Radio buttons
    const radioSi = document.getElementById('radioSi');
    const radioNo = document.getElementById('radioNo');

    // 1. Mostrar u ocultar input al seleccionar "Otro código postal"
    selectCodigoPostal.addEventListener('change', function() {
        if (this.value === 'otro') {
            inputOtroCP.style.display = 'block';
            inputOtroCP.setAttribute('required', 'true');
        } else {
            inputOtroCP.style.display = 'none';
            inputOtroCP.removeAttribute('required');
            inputOtroCP.value = '';
        }
    });

    // 2. Mostrar u ocultar input al seleccionar "Escribe tu propia empresa"
    selectEmpresa.addEventListener('change', function() {
        if (this.value === 'otra') {
            inputOtraEmpresa.style.display = 'block';
            inputOtraEmpresa.setAttribute('required', 'true');
        } else {
            inputOtraEmpresa.style.display = 'none';
            inputOtraEmpresa.removeAttribute('required');
            inputOtraEmpresa.value = '';
        }
    });

    // 3. Mostrar u ocultar input al seleccionar "Escribe tu propio curso"
    selectCursos.addEventListener('change', function() {
        if (this.value === 'otro') {
            inputOtroCurso.style.display = 'block';
            inputOtroCurso.setAttribute('required', 'true');
        } else {
            inputOtroCurso.style.display = 'none';
            inputOtroCurso.removeAttribute('required');
            inputOtroCurso.value = '';
        }
    });

    // 4. Bloquear / Desbloquear completamente Empresa y Cursos si elige "No" en cursos anteriores
    radioNo.addEventListener('change', function() {
        if (this.checked) {
            // Bloquear Empresa
            selectEmpresa.value = '';
            selectEmpresa.disabled = true;
            selectEmpresa.removeAttribute('required');
            labelEmpresa.style.opacity = '0.4';
            inputOtraEmpresa.style.display = 'none';
            inputOtraEmpresa.disabled = true;
            inputOtraEmpresa.removeAttribute('required');
            inputOtraEmpresa.value = '';

            // Bloquear Cursos
            selectCursos.value = '';
            selectCursos.disabled = true;
            selectCursos.removeAttribute('required');
            labelCursos.style.opacity = '0.4';
            inputOtroCurso.style.display = 'none';
            inputOtroCurso.disabled = true;
            inputOtroCurso.removeAttribute('required');
            inputOtroCurso.value = '';
        }
    });

    radioSi.addEventListener('change', function() {
        if (this.checked) {
            // Habilitar Empresa
            selectEmpresa.disabled = false;
            selectEmpresa.setAttribute('required', 'true');
            labelEmpresa.style.opacity = '1';
            inputOtraEmpresa.disabled = false;

            // Habilitar Cursos
            selectCursos.disabled = false;
            selectCursos.setAttribute('required', 'true');
            labelCursos.style.opacity = '1';
            inputOtroCurso.disabled = false;
        }
    });

    // 5. Validación con SweetAlert2 antes de enviar
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "¡Inscripción Exitosa!",
            text: "Tus datos han sido procesados correctamente.",
            icon: "success",
            draggable: true,
            confirmButtonColor: "#003366",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});