$(document).ready(function () {
    listPerfil();
});

var listPerfil = function () {
    var table = $('#dt_perfil').DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: 'excel',
                footer: true,
                title: "Lista de Perfiles",
                filename: "ListPerfil",
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
            "url": "ajax.php?module=Perfil&controller=Perfil&function=data",
            "method": "post"
        },
        "deferRender": true,
        "columns": [
            { "data": "id" },
            { "data": "description" },
            { "data": "status" },
            { "data": "buttons" }
        ]
    });

    showModalsPerfil("#dt_perfil tbody", table);
}

var showModalsPerfil = function (tbody, table) {
    $(tbody).on("click", ".btnShowEdit", function () {
        var url = $(this).attr("data-url");
        $.ajax({
            url: url,
            dataType: "JSON",
            success: function (rs) {
                console.log(rs);
                $("#idPerfilEdit").val(rs.id);
                $("#per_descripcionEdit").val(rs.description);
                $("#per_estadoEdit").val(rs.estado);
            },
            error: function (xhr, status, error) {
                console.error('Error loading profile data:', error);
                alert('Error al cargar los datos del perfil');
            }
        });
    });

    $(tbody).on("click", "#btnDelete", function () {
        // Aquí puedes agregar la funcionalidad de eliminar si es necesaria
    });
};