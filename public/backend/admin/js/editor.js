// Editor chính
ClassicEditor.create( document.querySelector( '#editor1' ) )
    .catch( error => {
        console.error( error );
    } );

// Editor phụ
ClassicEditor.create( document.querySelector( '#editor2' ) )
    .catch( error => {
        console.error( error );
    } );

