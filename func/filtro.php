<?php
function filtroEspecialidade($where)
{

    if (!empty($_GET['especialidade'])) {

        $especialidades = [];

        foreach ($_GET['especialidade'] as $esp) {

            $especialidades[] =
                "especialidade = '$esp'";
        }

        $where .= "AND (" . implode(' OR ', $especialidades) . ")";
    }

    return $where;
}

function filtroStatus($where)
{

    if (!empty($_GET['status'])) {

        $status_array = [];

        foreach ($_GET['status'] as $st) {

            $status_array[] =
                "status = '$st'";
        }

        $where .= "AND (" . implode(' OR ', $status_array) . ")";
    }

    return $where;
}