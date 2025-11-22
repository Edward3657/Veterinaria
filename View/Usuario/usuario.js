$(document).ready(function () {
    listUsuario();
});

var listUsuario = function () {
    var table = $('#dt_usuario').DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: 'excel',
                footer: true,
                title: "Lista de Usuarios",
                filename: "ListUsuario",
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
            "url": "ajax.php?module=Usuario&controller=Usuario&function=data",
            "method": "post"
        },
        "deferRender": true,
        "columns": [
            { "data": "id" },
            { "data": "login" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "email" },
            { "data": "estado" },
            { "data": "perfil" },
            { "data": "buttons" }
        ]
    });

    showModalsUsuario("#dt_usuario tbody", table);
}

var showModalsUsuario = function (tbody, table) {
    $(tbody).on("click", ".btnShowEdit", function () {
        var url = $(this).attr("data-url");
        $.ajax({
            url: url,
            dataType: "JSON",
            success: function (rs) {
                console.log(rs);
                $("#idUsuarioEdit").val(rs.id);
                $("#usu_identificacionEdit").val(rs.identificacion);
                $("#usu_loginEdit").val(rs.login);
                $("#usu_nombreEdit").val(rs.nombre);
                $("#usu_apellidoEdit").val(rs.apellido);
                $("#usu_emailEdit").val(rs.email);
                $("#usu_dirEdit").val(rs.direccion);
                $("#usu_telEdit").val(rs.telefono);
                $("#usu_estadoEdit").val(rs.estado);
                $("#per_idEdit").val(rs.perfil_id);
            },
            error: function (xhr, status, error) {
                console.error('Error loading user data:', error);
                alert('Error al cargar los datos del usuario');
            }
        });
    });

    $(tbody).on("click", "#btnDelete", function () {
        // Aquí puedes agregar la funcionalidad de eliminar si es necesaria
    });
};