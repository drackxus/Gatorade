(function( $ ){

    DownloadRC = function () {

        serialiceData = "action=generarExcelRegistros";

        $.ajax({
                type: "POST"
            ,   url: MyAjax.url
            ,   dataType: "json"
            ,   data: serialiceData
            ,   beforeSend: function(){
                }
            ,   success: function( msn ){
                    if (msn.validate) {
                        var link = document.createElement( 'a' );
                        link.href = msn.link;
                        link.download = "Registros Arbol Naranja.xlsx";
                        link.click();
                    }else{
                        alert( 'No hay Registos' );
                    }

                }

            ,   error: function( msn ){
                    console.log( msn );
                }

            , complete: function(){
                }
        });

    };


    this.DownloadRC;

})( jQuery );