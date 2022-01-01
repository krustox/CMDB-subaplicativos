$(document).foundation()

$(window).on('load',function(){

  if($("#aplicativo").length > 0){

    len = $("body table").length
    i=0
    for (i = 0; i < len; i++) {
      name = $( "#subaplicaciones"+i ).attr('name');
      id= name.split(',')[0];
      afa= name.split(',')[1];
      LlenarTabla(id,i,afa);
    }

  }else if($("#servicios").length > 0){
    LlenarTablaServicios(GetURLParameter("id"),'');
    LlenarTablaCanales(GetURLParameter("id"),'');
  }else if($("#resultado-canal").length > 0){
    LlenarTablaCanales('',GetURLParameter("id"));
  }else if($("#resultado-servicio").length > 0){
    LlenarTablaServicios('',GetURLParameter("id"));
  }

});

function GetURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}

function LlenarTabla(id,len,afa){
  $.getJSON( "../api/subaplicativos.php?id="+id+"&afa="+afa, function( data ) {
    $.each( data, function( key, val ) {
      if(val["AFA_FIN"] == 1){
        fin = "SI";
        $( "#subaplicaciones"+len ).append( "<tr><td>"+val["ID"]+"</td><td>"+val["NOMBRE"]+"</td><td>"+val["AFA"]+"</td><td>"+val["RA"]+"</td><td>"+fin+"</td> <td></td></tr>" );
      }else{
        fin="NO";
        $( "#subaplicaciones"+len ).append( "<tr><td>"+val["ID"]+"</td><td>"+val["NOMBRE"]+"</td><td>"+val["AFA"]+"</td><td>"+val["RA"]+"</td><td>"+fin+"</td> <td><a href=\"subaplicativos.php?id="+val["ID"]+"\">Ver Subaplicativo </a><br /><a onclick=\"NoVigente('"+val["ID"]+"','"+id+"')\"> No Vigente </a><br /><a onclick=\"NoAfa('"+val["ID"]+"','"+id+"')\"> Eliminar </a><br /><a onclick=\"Fin('"+val["ID"]+"','"+id+"')\"> Finalizado </a></td></tr>" );
      }

    });
  });
}

function LlenarTablaServicios(id_subaplicativo,id){
  if(id_subaplicativo == ''){
    $.getJSON( "../api/servicio.php?id_subaplicativo="+id, function( data ) {
      $( "#resultado-servicio" ).empty();
      $( "#resultado-servicio" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Descripcion</th><th>Canal</th><th>Tripleta</th><th>Gestor</th><th>Acción</th></tr></thead><tbody>");
      $.each(data, function( key, val ) {
        $( "#resultado-servicio" ).append( "<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td> <td>" +val["DESCRIPCION"] +"</td><td>" +val["CANAL"] +"</td><td>" +val["TRIPLETA"] +"</td><td>" +val["GESTOR"] +"</td><td> <a onclick=\"agregar_servicio('"+val["ID"]+"','"+id+"')\">Agregar</a> </td> </tr>");
      });
    });
  }else{
    $.getJSON( "../api/servicio.php?id="+id_subaplicativo, function( data ) {
      $( "#servicios0" ).empty();
      $( "#servicios0" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Descripcion</th><th>Canal</th><th>Tripleta</th><th>Gestor</th><th>Acción</th></tr></thead><tbody>");
      $.each(data, function( key, val ) {
        $( "#servicios0" ).append( "<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td> <td>" +val["DESCRIPCION"] +"</td><td>" +val["CANAL"] +"</td><td>" +val["TRIPLETA"] +"</td><td>" +val["GESTOR"] +"</td><td> <a onclick=\"eliminar_servicio('"+val["ID"]+"','"+id_subaplicativo+"')\">Eliminar</a> </td> </tr>");
      });
    });
  }
}

function LlenarTablaCanales(id_subaplicativo,id){
  if(id_subaplicativo != ''){
  $.getJSON( "../api/canal.php?id="+id_subaplicativo, function( data ) {
    $( "#canales0" ).empty();
    $( "#canales0" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Acción</th></tr></thead><tbody>");
    $.each(data, function( key, val ) {
      $( "#canales0" ).append( "<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td><td> <a onclick=\"eliminar_canal('"+val["ID"]+"','"+id_subaplicativo+"')\">Eliminar</a> </td> </tr>");
      });
  });
  }else{
    $.getJSON( "../api/canal.php?id_subaplicativo="+id, function( data ) {
    $( "#resultado-canal" ).empty();
    $( "#resultado-canal" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Acción</th></tr></thead><tbody>");
    $.each(data, function( key, val ) {
      $( "#resultado-canal" ).append( "<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td><td> <a  onclick=\"agregar_canal('"+val["ID"]+"','"+id+"')\">Agregar</a> </td> </tr>");
      });
  });
  }
}

function myFunction(tabla) {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById(tabla);
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  if(tabla == "resultado-canal"){
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        td2 = tr[i].getElementsByTagName("td")[1];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1
              || td2.innerHTML.toUpperCase().indexOf(filter) > -1  ) {
              tr[i].style.display = "";
          } else {
              tr[i].style.display = "none";
          }
        }
      }
    }else if(tabla == "resultado-servicio"){
      for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[0];
          td2 = tr[i].getElementsByTagName("td")[1];
          td3 = tr[i].getElementsByTagName("td")[2];
          td4 = tr[i].getElementsByTagName("td")[3];
          td5 = tr[i].getElementsByTagName("td")[4];
          td6 = tr[i].getElementsByTagName("td")[5];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1
                || td2.innerHTML.toUpperCase().indexOf(filter) > -1
                || td3.innerHTML.toUpperCase().indexOf(filter) > -1
                || td4.innerHTML.toUpperCase().indexOf(filter) > -1
                || td5.innerHTML.toUpperCase().indexOf(filter) > -1
                || td6.innerHTML.toUpperCase().indexOf(filter) > -1  ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
          }
        }
    }

}

function agregar_servicio(id,subap){

  swal({
  title: "Desea Agregar el servicio con id: "+id+" al subaplicativo con id:"+subap+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willAdd) {
  if (willAdd) {
    $.ajax({ type: "GET",
       url: "../api/servicio_agregar.php?id_servicio=" + id +"&id_subaplicativo="+ subap,
       async: false,
     datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }/* else {
    swal("Your imaginary file is safe!");
  }*/
  });
  /*
	if (confirm("Desea agregar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",
     url: "../api/servicio_agregar.php?id_servicio=" + id +"&id_subaplicativo="+ subap,
     async: false,
	 datatype: "html",
     success : function(data)
     {
		       window.location = window.location.href;
		       window.alert(data);
           response= data;
     }
	});
  }
    return false;*/
}

function eliminar_servicio(id,subap){

  swal({
  title: "Desea eliminar el servicio con id: "+id+" al subaplicativo con id:"+subap+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willDelete) {
  if (willDelete) {
    $.ajax({ type: "GET",
       url: "../api/servicio_eliminar.php?id_servicio=" + id +"&id_subaplicativo="+ subap,
       async: false,
     datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }/* else {
    swal("Your imaginary file is safe!");
  }*/
  });
  /*	if (confirm("Desea eliminar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",
     url: "../api/servicio_eliminar.php?id_servicio=" + id +"&id_subaplicativo="+ subap,
     async: false,
	 datatype: "html",
     success : function(data)
     {
		       window.location = window.location.href;
		       window.alert(data);
           response= data;
     }
	});
  }
    return false;*/
}

function agregar_canal(id,subap){

  swal({
  title: "Desea Agregar el canal con id: "+id+" al subaplicativo con id:"+subap+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willAdd) {
  if (willAdd) {
    $.ajax({ type: "GET",
       url: "../api/canal_agregar.php?id_canal=" + id +"&id_subaplicativo="+ subap,
       async: false,
     datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }/* else {
    swal("Your imaginary file is safe!");
  }*/
  });
  /*  if (confirm("Desea agregar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",
     url: "../api/canal_agregar.php?id_canal=" + id +"&id_subaplicativo="+ subap,
     async: false,
	 datatype: "html",
     success : function(data)
     {
		       window.location = window.location.href;
		       window.alert(data);
           response= data;
     }
	});
  }
    return false;*/
}


function eliminar_canal(id,subap){

  swal({
  title: "Desea eliminar el canal con id: "+id+" al subaplicativo con id:"+subap+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willDelete) {
  if (willDelete) {
    $.ajax({ type: "GET",
       url: "../api/canal_eliminar.php?id_canal=" + id +"&id_subaplicativo="+ subap,
       async: false,
  	 datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }/* else {
    swal("Your imaginary file is safe!");
  }*/
  });
	/*if (confirm("Desea eliminar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",
     url: "../api/canal_eliminar.php?id_canal=" + id +"&id_subaplicativo="+ subap,
     async: false,
	 datatype: "html",
     success : function(data)
     {
		       window.location = window.location.href;
		       window.alert(data);
           response= data;
     }
	});
  }
    return false;*/
}

function NoVigente(id_sub,id_app){

  swal({
  title: "Desea asignar 'No Vigente' el subaplicativo con id: "+id_sub+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willDelete) {
  if (willDelete) {
    $.ajax({ type: "GET",
       url: "../api/NoVigente.php?id_sub=" + id_sub +"&id_app="+ id_app,
       async: false,
  	 datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }
  });
}

function Fin(id_sub,id_app){

  swal({
  title: "Desea marcar como Finalizado el subaplicativo con id: "+id_sub+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willDelete) {
  if (willDelete) {
    $.ajax({ type: "GET",
       url: "../api/finalizado.php?id_sub=" + id_sub +"&id_app="+ id_app,
       async: false,
  	 datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }
  });
}

function NoAfa(id_sub,id_app){

  swal({
  title: "Desea quitar el subaplicativo con id: "+id_sub+" de su lista?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willDelete) {
  if (willDelete) {
    $.ajax({ type: "GET",
       url: "../api/NoAfa.php?id_sub=" + id_sub +"&id_app="+ id_app,
       async: false,
  	 datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }
  });
	}

  function cambiarRA(id_sub){
    ra = $( "#RA").val();
    swal({
    title: "Desea cambiar el RA del subaplicativo con id: "+id_sub+"?",
    text: "",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then(function(willDelete) {
    if (willDelete) {
      $.ajax({ type: "GET",
         url: "../api/cambiarRA.php?id_sub=" + id_sub+"&ra="+ ra,
         async: false,
    	 datatype: "html",
         success : function(data)
         {
            swal(data, {
              icon: "success",
            }).then(function(data){
              window.location = 'subaplicativos.php?id='+id_sub;
            });
          }
          });
    }
    });
  	}

    $(function(){ // this will be called when the DOM is ready
    $('#RA').keyup(function() {
      ra = $( "#RA").val();
      name = $( "#RA" ).attr('value');
      if(ra != name){
        if(ra.includes(" ")){
          $('#error').empty();
          $('#error').append("<strong>Usuario incorrecto</strong>");
          $('#guardar').hide("slow");
        }else{
          $.ajax({ type: "GET",
             url: "../api/consultaldap.php?name=" + ra ,
             async: true,
           datatype: "html",
             success : function(data)
             {
                if(!data.trim().includes(" ")){
                  $('#error').empty();
                  $('#error').append("<strong>Usuario incorrecto</strong>");
                  $('#guardar').hide("slow");
                }else{
                  $('#error').empty();
				  $('#error').append(data);
                  $('#guardar').show('slow');
                }
              }
              });
        }
      }else{
        $('#error').empty();
        $('#guardar').hide("slow");
      }
    });
  });
