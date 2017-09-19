   function openModal(Tipo){
        if(Tipo == 1){
             $('#ModalLoginForm').modal('show');
        }else{
             $('#ModalLoginFormE').modal('show');
        }

    }
    function openModalConfirmacion(){
        var titulo = $("#titulo").val().length;
        var tituloC = $("#tituloComercial").val().length;
        var problematica = $("#problematica").val().length;
        var descripcion = $("#descripcion").val().length;
        var nomPart = $("#nomPart").val().length;
        var correoPart = $("#correoPart").val().length;
        var telPart = $("#telPart").val().length;

        var numeroRegistro = $("#numeroRegistro").val().length;
        var otro= $("#otro_ObjetivoProyecto").val().length;

        var desIES = $("#desIES").val().length;
        var descRiesgo = $("#descRiesgo").val().length;
        var estMitigacion = $("#estMitigacion").val().length;
        var analisisEnt= $("#analisisEnt").val().length;

        var recursosHumanos =$("#recursosHumanos").val().length;
        var recursosTec= $("#recursosTec").val().length;
        var recursosFin=$("#recursosFin").val().length;
        var usoApp = $("#usoApp").val().length;
        var viabilidad=$("#viabilidad").val().length;
        var beneficios=$("#beneficios").val().length;

        $('#ModalConfirmacionForm').modal('show');
    }
    function mostrarModalError(){
     $('#ModalLoginForm').modal('show');
     }
