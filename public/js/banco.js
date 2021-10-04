$(document).ready(function(){
    var expregSiglas= /^[A-Z]\.[A-Z]$/;
    var expregNombre= /^[A-Z]+/;
    let edit = false;
    cargarTabla();
     
     function cargarTabla(){
        $.get('http://localhost/laminasCrud/public/bank/tabla',e=>{
            let template = '';
            e.forEach(datos => {
            template += `
                    <tr id="${datos.id}">
                    <td>${datos.nombre}</td>
                    <td>${datos.codigo}</td>
                    <td>${datos.siglas}</td>
                    <td>${datos.codsc}</td>
                    <td>${datos.estado}</td>
                    <td>
                        <button class="btn btn-danger" id="btnEliminar">
                        Delete 
                        </button>
                        <button class="btn btn-success" id="btnActualizar">
                        Update
                        </button>
                    </td>
                    </tr>
                    `
            });
            $('#tabla').html(template);
        });
     }

     $("#frmIngreso").submit(event=>{ 
        event.preventDefault();
        const data = {
            id : $("#id").val(),
            nombre : $("#nombre").val(),
            codigo: $("#codigo").val(),
            siglas: $("#siglas").val(),
            codsc: $("#codsc").val(),
            estado: $("#estado").val()
        };
        if(expregSiglas.test($("#siglas").val()) && expregNombre.test($("#nombre").val())) {
            const url = edit === false ? "http://localhost/laminasCrud/public/bank/add" : 
            'http://localhost/laminasCrud/public/bank/update';
           
                $.post(url, data, (response) => {
                $('#frmIngreso').trigger('reset');
                cargarTabla();
                });
                edit=false;
        }else{
            alert("Debe completar los campos.");
            if( !$("#nombre").val())
            $("#nombre").focus();
            if( !$("#siglas").val())
            $("#siglas").focus();
        }
     });

     $(document).on('click', '#btnEliminar', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('id');
        $.post('http://localhost/laminasCrud/public/bank/delete', {id}, (response) => {
          cargarTabla();
        });
    });
  
    $(document).on('click', '#btnActualizar', (e) => {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('id');
      $.post('http://localhost/laminasCrud/public/bank/edit', {id}, (response) => {
      $('#id').val(response[0].id);
      $('#nombre').val(response[0].nombre);
      $('#codigo').val(response[0].codigo);
      $('#siglas').val(response[0].siglas);
      $('#codsc').val(response[0].codsc);
      $('#estado').val(response[0].estado);
      edit = true;
      });
      e.preventDefault();
    });

  }); 
