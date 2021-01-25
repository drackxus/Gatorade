$(function() {
    console.log("bjbk");

    setTimeout(function() {
        Tour.run([{
                element: $('#meta-box-video-youtube'),
                content: 'Desde aqui podras crear o editar el contenido de tu publicacion',
                position: 'left',
                close: false,
                language: 'es'
            },
            {
                element: $('#meta-box-video-loop'),
                content: 'and the second one<br>description might be <strong>HTML</strong>',
                position: 'left',
                close: false,
                language: 'es'
            },
            {
                element: $('#meta-box-poster-video'),
                content: 'and the second one<br>description might be <strong>HTML</strong>',
                position: 'left',
                close: false,
                language: 'es'
            }
        ]);
        console.log("gg");


    }, 6000);


});