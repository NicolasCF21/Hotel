let txtEmail =document.getElementById('email')
txtEmail.addEventListener('blur', function(){
    emailExiste(txtEmail.value)
}, false)

let txtDocumento =document.getElementById('documento')
txtDocumento.addEventListener('blur', function(){
    documentoExiste(txtDocumento.value)
}, false)

let txtNombre =document.getElementById('nombre')
txtNombre.addEventListener('blur', function(){
    campoNombre(txtNombre.value)
}, false)

let txtApellido =document.getElementById('apellido')
txtApellido.addEventListener('blur', function(){
    campoApellido(txtApellido.value)
}, false)

let txtTelefono =document.getElementById('telefono')
txtTelefono.addEventListener('blur', function(){
    campoTelefono(txtTelefono.value)
}, false)

let txtDocu =document.getElementById('documento')
txtDocu.addEventListener('blur', function(){
    campoDocumento(txtDocu.value)
}, false)

let txtCorreo =document.getElementById('email')
txtCorreo.addEventListener('blur', function(){
    esEmail(txtCorreo.value)
}, false)

let txtPass =document.getElementById('password2')
txtPass.addEventListener('blur', function(){
    validarPassword(txtPass.value)
}, false)
let txtFecha =document.getElementById('fecha')
txtFecha.addEventListener('blur', function(){
    mayorEdad(txtFecha.value)
}, false)

function mayorEdad(fecha){
  let url = "http://localhost/hotel/config/usuarioAjax.php"
  let form = new FormData()
  form.append("action", "mayorEdad")
  form.append("fecha",fecha)

  fetch(url,{
      method: 'POST',
      body: form
  }).then(response => response.json())
  .then(data => {
    if(data.ok){
      document.getElementById('fecha').value = ''
      document.getElementById('edad').innerHTML = '¡Debe ser mayor de edad!'
    }else{
      document.getElementById('edad').innerHTML = ''
    }
  })
}

function emailExiste(email){
    let url = "http://localhost/hotel/config/usuarioAjax.php"
    let form = new FormData()
    form.append("action", "emailExiste")
    form.append("email",email)

    fetch(url,{
        method: 'POST',
        body: form
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('email').value = ''
        document.getElementById('validaEmail').innerHTML = '¡Email ya esta registrado!'
      }else{
        document.getElementById('validaEmail').innerHTML = ''
      }
    })
}

function documentoExiste(documento){
    let url = "http://localhost/hotel/config/usuarioAjax.php"
    let form = new FormData()
    form.append("action", "documentoExiste")
    form.append("documento",documento)

    fetch(url,{
        method: 'POST',
        body: form
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('documento').value = ''
        document.getElementById('validaDoc').innerHTML = '¡Documento ya esta registrado!'
      }else{
        document.getElementById('validaDoc').innerHTML = ''
      }
    })
}
function campoNombre(nombre){
  let url = "http://localhost/hotel/config/usuarioAjax.php"
  let form = new FormData()
  form.append("action", "campoNombre")
  form.append("nombre",nombre)

  fetch(url,{
      method: 'POST',
      body: form
  }).then(response => response.json())
  .then(data => {
    if(data.ok){
      document.getElementById('nombre').value
      document.getElementById('validaNom').innerHTML = '¡Solo se permiten letras!'
    }else{
      document.getElementById('validaNom').innerHTML = ''
    }
  })
}
function campoApellido(apellido){
    let url = "http://localhost/hotel/config/usuarioAjax.php"
    let form = new FormData()
    form.append("action", "campoApellido")
    form.append("apellido",apellido)
  
    fetch(url,{
        method: 'POST',
        body: form
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('apellido').value
        document.getElementById('validaAp').innerHTML = '¡Solo se permiten letras!'
      }else{
        document.getElementById('validaAp').innerHTML = ''
      }
    })
  }
  function campoTelefono(telefono){
    let url = "http://localhost/hotel/config/usuarioAjax.php"
    let form = new FormData()
    form.append("action", "campoTelefono")
    form.append("telefono",telefono)
  
    fetch(url,{
        method: 'POST',
        body: form
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('telefono').value
        document.getElementById('validaTel').innerHTML = '¡Solo se permiten números!'
      }else{
        document.getElementById('validaTel').innerHTML = ''
      }
    })
  }

  function campoDocumento(documento){
    let url = "http://localhost/hotel/config/usuarioAjax.php"
    let form = new FormData()
    form.append("action", "campoDocumento")
    form.append("documento",documento)
  
    fetch(url,{
        method: 'POST',
        body: form
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('documento').value
        document.getElementById('validaDocu').innerHTML = '¡Solo se permiten números!'
      }else{
        document.getElementById('validaDocu').innerHTML = ''
      }
    })
  }
  function esEmail(email){
    let url = "http://localhost/hotel/config/usuarioAjax.php"
    let form = new FormData()
    form.append("action", "esEmail")
    form.append("email",email)

    fetch(url,{
        method: 'POST',
        body: form
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('email').value
        document.getElementById('validaCorreo').innerHTML = '¡Email no es valido!'
      }else{
        document.getElementById('validaCorreo').innerHTML = ''
      }
    })
}

