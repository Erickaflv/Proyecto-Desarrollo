// Desestructuramos las herramientas de WordPress que necesitamos
var el = wp.element.createElement;
var registerBlockType = wp.blocks.registerBlockType;

registerBlockType( 'mi-plugin/bloque-demo', {
    title: 'Bloque Demostrativo', 
    icon: 'smiley',               
    category: 'design',

    // La función 'edit' controla lo que se ve MIENTRAS editas la página
    edit: function() {
        return el(
            'div',
            { 
                style: { 
                    backgroundColor: '#e0f7fa', 
                    padding: '20px', 
                    border: '2px solid #00bcd4',
                    borderRadius: '8px',
                    textAlign: 'center',
                    fontFamily: 'sans-serif'
                } 
            },
            'Prueba de bloque para gutenberg'
        );
    },

    // La función 'save' controla lo que se guarda en la base de datos y se ve en la web
    save: function() {
        return el(
            'div',
            { 
                style: { 
                    backgroundColor: '#e0f7fa', 
                    padding: '20px', 
                    border: '2px solid #00bcd4',
                    borderRadius: '8px',
                    textAlign: 'center',
                    fontFamily: 'sans-serif'
                } 
            },
            'Prueba de bloque para gutenberg'
        );
    }
} );