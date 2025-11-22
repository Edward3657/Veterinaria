$(document).ready(function () {
    listVeterinario();
});

var listVeterinario = function () {
    var table = $('#dt_veterinario').DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: 'excel',
                footer: true,
                title: "Lista de Veterinarios",
                filename: "ListVeterinario",
                text: '<button class="btn btn-success">Exportar a Excel</button>'
            },
        ],
        destroy: true,
        responsive: true,
        searching: true,
        orderable: false,
        lengthChange: false,
        pageLength: 15,
        autoWidth: true,
        "ajax": {
            "url": "ajax.php?module=Veterinario&controller=Veterinario&function=data",
            "method": "post"
        },
        "deferRender": true,
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "email" },
            { "data": "telefono" },
            { "data": "veterinaria" },
            { "data": "direccion" },
            { "data": "estado" },
            { "data": "buttons" }
        ]
    });

    showModalsVeterinario("#dt_veterinario tbody", table);
}

var showModalsVeterinario = function (tbody, table) {
    $(tbody).on("click", ".btnShowEdit", function () {
        var url = $(this).attr("data-url");
        $.ajax({
            url: url,
            dataType: "JSON",
            success: function (rs) {
                console.log(rs);
                $("#idVeterinarioEdit").val(rs.id);
                $("#vet_nombreEdit").val(rs.nombre);
                $("#vet_emailEdit").val(rs.email);
                $("#vet_telEdit").val(rs.telefono);
                $("#vet_veterinariaEdit").val(rs.veterinaria);
                $("#vet_direccionEdit").val(rs.direccion);
            },
            error: function(xhr, status, error) {
                console.error('Error loading veterinarian data:', error);
                alert('Error al cargar los datos del veterinario');
            }
        });
        // En showModalsVeterinario function, después del éxito del AJAX
$(document).on('submit', 'form[name="frmCreateVeterinario"]', function(e) {
    var email = $('#vet_email').val();
    var telefono = $('#vet_tel').val();
    
    // Validación básica de email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Por favor ingrese un email válido');
        e.preventDefault();
        return false;
    }
    
    // Aquí podrías hacer una llamada AJAX para verificar si existe antes de enviar
});
    });
    
    $(tbody).on("click", "#btnDelete", function () {
        // Aquí puedes agregar la funcionalidad de eliminar si es necesaria
    });
};