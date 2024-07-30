

const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnBuscar = document.getElementById('btnBuscar');
const btnCancelar = document.getElementById('btnCancelar');
const btnLimpiar = document.getElementById('btnLimpiar');
const tablacita= document.getElementById('tablacita');
const formulario = document.querySelector('form');

btnModificar.parentElement.style.display = 'none';
btnCancelar.parentElement.style.display = 'none';

const getCita = async (alerta='si') => {

    const fecha = formulario.cit_fecha.value;
    const pais  = formulario.cit_pais.value;
    const cliente = formulario.cit_cliente.value;
    const mascota = formulario.cit_mascota.value;

    const url = `/cuxum_raxcaco_ejercicio_de_practica/controllers/cita/index.php?cit_fecha=${fecha}&cit_pais=${pais}&cit_cliente=${cliente}&cit_mascota=${mascota}`;
    const config = {
        method: 'GET'
    }
      
    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
        tablacita.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment()
        let contador = 1
        if (respuesta.status == 200) {
            if(alerta=='si'){
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: 'citas encontrado',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
                 }
            if (data.length > 0) {
                data.forEach(cita => {
                    const tr = document.createElement('tr')
                    const celda1 = document.createElement('td')
                    const celda2 = document.createElement('td')
                    const celda3 = document.createElement('td')
                    const celda4 = document.createElement('td')
                    const celda5 = document.createElement('td')
                    const celda6 = document.createElement('td')
                    const celda7 = document.createElement('td')
                    const buttonModificar = document.createElement('button')
                    const buttonEliminar = document.createElement('button')

                    celda1.innerText = contador;
                    celda2.innerText = cita.cit_cliente;
                    celda3.innerText = cita.cit_mascota;
                    celda4.innerText = cita.cit_fecha;
                    celda5.innerText = cita.cit_pais;

                    buttonModificar.textContent = 'Modificar'
                    buttonModificar.classList.add('btn', 'btn-warning', 'w-100')
                    buttonModificar.addEventListener('click',()=>llenardatos(cita))


                    buttonEliminar.textContent = 'Eliminar'
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100')
                    buttonEliminar.addEventListener('click', () => eliminar(cita.cit_codigo));

                    celda6.appendChild(buttonModificar)
                    celda7.appendChild(buttonEliminar)

                    tr.appendChild(celda1)
                    tr.appendChild(celda2)
                    tr.appendChild(celda3)
                    tr.appendChild(celda4)
                    tr.appendChild(celda5)
                    tr.appendChild(celda6)
                    tr.appendChild(celda7)
                    fragment.appendChild(tr);

                    contador++
                });

            } else {
                const tr = document.createElement('tr')
                const td = document.createElement('td')
                td.innerText = 'No hay areas disponibles'
                td.colSpan = 7;

                tr.appendChild(td)
                fragment.appendChild(tr)
            }
        } else {
            console.log('hola');
        }

        tablacita.tBodies[0].appendChild(fragment)
    } catch (error) {
        console.log(error);
    }
}


getCita();


const guardarcita = async (e) => {
    e.preventDefault();
    btnGuardar.disabled = true;

    const url = '/cuxum_raxcaco_ejercicio_de_practica/controllers/cita/index.php'
    const formData = new FormData(formulario)

    formData.append('tipo', 1)
    formData.delete('cit_codigo')

    const config = {
        method: 'POST',
        body: formData
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
        const { mensaje, codigo, detalle } = data
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
        // alert(mensaje)
        console.log(data);
        if (codigo == 1 && respuesta.status == 200) {
            formulario.reset();
            getCita(alerta='no');
           
        } else {
            console.log(detalle);
        }

    } catch (error) {
        console.log(error);
    }
    btnGuardar.disabled = false;
}



const llenardatos =(cita) => {
    formulario.cit_codigo.value = cita.cit_codigo
    formulario.cit_fecha.value = cita.cit_fecha
    formulario.cit_pais.value = cita.cit_pais
    formulario.cit_cliente.value = cita.cit_cliente
    formulario.cit_mascota.value = cita.cit_mascota
    btnBuscar.parentElement.style.display = 'none'
    btnGuardar.parentElement.style.display = 'none'
    btnLimpiar.parentElement.style.display = 'none'
    btnModificar.parentElement.style.display = ''
    btnCancelar.parentElement.style.display = ''
}

const modificar= async (e) => {
    e.preventDefault();
    btnModificar.disabled = true;

    const url = '/cuxum_raxcaco_ejercicio_de_practica/controllers/cita/index.php'
    const formData = new FormData(formulario)
    formData.append('tipo', 2)
    const config = {
        method: 'POST',
        body: formData
    }

    try {
        console.log('Enviando datos:', ...formData.entries());
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log('Respuesta recibida:', data);
        const { mensaje, codigo, detalle } = data;
        if (respuesta.ok && codigo === 2) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: "modificado correctamente",
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
            formulario.reset()
            getCita(alerta='no'); 
            btnBuscar.parentElement.style.display = ''
            btnGuardar.parentElement.style.display = ''
            btnLimpiar.parentElement.style.display = ''
            btnModificar.parentElement.style.display = 'none'
            btnCancelar.parentElement.style.display = 'none'
         
        } else {
            console.log('Error:', detalle);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error al modificar',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    } catch (error) {
        console.log('Error de conexión:', error);
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: 'Error de conexión',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
    }
    
    btnModificar.disabled = false;

}


const cancelar= async (e) => {
    e.preventDefault();
    btnCancelar.disabled = true;
    formulario.reset();
    btnBuscar.parentElement.style.display = ''
    btnGuardar.parentElement.style.display = ''
    btnLimpiar.parentElement.style.display = ''
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.parentElement.style.display = 'none'
  
    
    btnCancelar.disabled = false;

}






const eliminar = async (ID) => {
    console.log(ID)
    const formData = new FormData();
    formData.append('tipo', 3);
    formData.append('cit_codigo', ID);
    
    console.log(formData)
    const url = '/cuxum_raxcaco_ejercicio_de_practica/controllers/cita/index.php';
    const config = {
        method: 'POST',
        body: formData
    };
    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log(data)
        const { mensaje, codigo, detalle } = data;
        if (respuesta.status == 200 && codigo === 3) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
            getCita(alerta='no');
        } else {
            console.log('Error:', detalle);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error al eliminar',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    } catch (error) {
        console.log('Error de conexión:', error);
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: 'Error de conexión',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
    }
};






formulario.addEventListener('submit',guardarcita)
btnBuscar.addEventListener('click',getCita)
btnModificar.addEventListener('click',modificar)   
btnCancelar.addEventListener('click', cancelar)   
 