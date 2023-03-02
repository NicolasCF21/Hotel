document.addEventListener('keyup', e=>{
    if(e.target.matches('#buscador')){
        document.querySelectorAll('.articulo').forEach(servicio =>{
            servicio.textContent.toLowerCase().includes(e.target.value.toLowerCase())
            ?servicio.classList.remove('filtro')
            :servicio.classList.add('filtro')

        })
    }
})