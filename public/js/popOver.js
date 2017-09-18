///  pop over
	$(function () {
		$("[data-toggle='popover']").popover({ trigger: "hover" });

        $("select[name=perProy]").change(function(){

            valor = $(this).val();

            if(valor === "5"){

                $('#otroBloque').css('display', 'block');
            }else{

                $('#otroBloque').css('display', 'none');
            }

        });

	});
