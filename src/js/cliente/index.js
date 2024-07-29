

const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnBuscar = document.getElementById('btnBuscar');
const btnCancelar = document.getElementById('btnCancelar');
const btnLimpiar = document.getElementById('btnLimpiar');
const tablacliente= document.getElementById('tablacliente');
const formulario = document.querySelector('form');

btnModificar.parentElement.style.display = 'none';
btnCancelar.parentElement.style.display = 'none';

const getCliente = async (alerta='si') => {


    const nombre = formulario.cli_nombre.value;
    const sexo  = formulario.cli_sexo.value;
    const telefono = formulario.cli_telefono.value;
    const pais = formulario.cli_pais.value;

    const url = `/cuxum_raxcaco_ejercicio_de_practica/controllers/cliente/index.php?cli_nombre=${nombre}&cli_sexo=${sexo}&cli_telefono=${telefono}&cli_pais=${pais}`;
    const config = {
        method: 'GET'
    }
    

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        tablacliente.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment();
        let contador = 1;
        console.log(data);
        if (respuesta.status == 200 ) {
            if(alerta=='si'){
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: 'Datos enonctrados',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }

            if (data.length > 0) {
                data.forEach(cliente => {
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
                    celda2.innerText = cliente.cli_nombre;
                    celda3.innerText = cliente.cli_sexo;
                    celda4.innerText = cliente.cli_telefono;
                    celda5.innerText = cliente.cli_pais;
                   
                    buttonModificar.textContent = 'Modificar'
                    buttonModificar.classList.add('btn', 'btn-warning', 'w-100')
                    buttonModificar.addEventListener('click',()=>llenardatos(cliente))


                    buttonEliminar.textContent = 'Eliminar'
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100')
                    buttonEliminar.addEventListener('click', () => eliminar(cliente.cli_codigo));

                    celda4.appendChild(buttonModificar)
                    celda5.appendChild(buttonEliminar)

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
                td.innerText = 'No hay clientes disponibles'
                td.colSpan = 7;

                tr.appendChild(td)
                fragment.appendChild(tr)
            }
        } else {
            console.log('hola');
        }

        tablacliente.tBodies[0].appendChild(fragment)
    } catch (error) {
        console.log(error);
    }
}

getCliente();


const guardarcliente = async (e) => {
    e.preventDefault();
    btnGuardar.disabled = true;

    const url = '/cuxum_raxcaco_ejercicio_de_practica/controllers/cliente/index.php'
    const formData = new FormData(formulario)

    formData.append('tipo', 1)
    formData.delete('pue_codigo')

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
            getCliente(alerta='no');
            formulario.reset();
        } else {
            console.log(detalle);
        }

    } catch (error) {
        console.log(error);
    }
    btnGuardar.disabled = false;
}



const llenardatos =(cliente) => {
    formulario.cli_codigo.value = cliente.cli_codigo
    formulario.cli_nombre.value = cliente.cli_nombre
    formulario.cli_sexo.value = cliente.cli_sexo
    formulario.cli_telefono.value = cliente.cli_telefono
    formulario.cli_pais.value = cliente.cli_pais
    btnBuscar.parentElement.style.display = 'none'
    btnGuardar.parentElement.style.display = 'none'
    btnLimpiar.parentElement.style.display = 'none'
    btnModificar.parentElement.style.display = ''
    btnCancelar.parentElement.style.display = ''
}

const modificar= async (e) => {
    e.preventDefault();
    btnModificar.disabled = true;

    const url = '/cuxum_raxcaco_ejercicio_de_practica/controllers/cliente/index.php'
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
            getCliente(alerta='no'); 
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





///////eliminar 



const eliminar = async (ID) => {
    console.log(ID)
    const formData = new FormData();
    formData.append('tipo', 3);
    formData.append('cli_codigo', ID);
    
    console.log(formData)
    const url = '/cuxum_raxcaco_ejercicio_de_practica/controllers/cliente/index.php';
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
            getCliente(alerta='no');
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






formulario.addEventListener('submit',guardarcliente)
btnBuscar.addEventListener('click',getCliente)
btnModificar.addEventListener('click',modificar)   
btnCancelar.addEventListener('click', cancelar)   
 