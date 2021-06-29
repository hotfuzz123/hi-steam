// ClassicEditor
//     .create( document.querySelector( '#editor1' ) )
//     .catch( error => {
//         console.error( error );
//     } );

// ClassicEditor
//     .create( document.querySelector( '#editor2' ) )
//     .catch( error => {
//         console.error( error );
//     } );

ClassicEditor.create( document.querySelector( '#editor1' ) )
    .then( editor => {
        window.editor1 = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );

ClassicEditor.create( document.querySelector( '#editor2' ) )
    .then( editor => {
        window.editor2 = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );

