/*==============================================================
=   ENVIO DE FORMULARIO PARA LA BUSQUEDO DE PRODUCTOS POR FILTRO EN LA TIENDA    =
================================================================*/
const mostrar = document.querySelector('#mostrar')

window.addEventListener('load', function() {
  if(document.querySelector("#formularioSearch")){
      let formProductos = document.querySelector("#formularioSearch");
      formProductos.onsubmit = function(e) {

          let categoria = document.querySelector('#categoria').value;
          let catColor = document.querySelector('#catColor').value;
          let catPre = document.querySelector('#catPresen').value;

         
          if(categoria == '' || catColor == '' || catPre == '' )
          {
              swal("Atención", "Todos los campos son obligatorios " , "error");
              return false;
          }

          let request = (window.XMLHttpRequest) ? new XMLHttpRequest() :new ActiveXObject('Microsoft.XMLHTTP');
         
          let ajaxUrl = base_url+'/Tienda/tienda'; 
          let formData = new FormData(formProductos);
        
          request.open("POST",ajaxUrl,true);
          request.send(formData);

          request.onreadystatechange = function(){
              if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                   
              }
          }
      }
  }

}, false);

