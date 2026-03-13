<!DOCTYPE html>
<html>
<head>
    <title>Richiesta codice fiscale </title>
</head>
<body>
    <div class="content">
        <p>{{ $dataView['messaggioPaziente'] }}</p>
        <ul>
            <li>ID paziente: <strong>{{ $dataView['idPaziente'] }}</strong></li>
            <li>Codice fiscale: <strong>{{ $dataView['cfPaziente'] }}</strong></li>
            <li>Note: <strong>{{ $dataView['note'] }}</strong></li>
        </ul>
    </div>
</body>
</html>