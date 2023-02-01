<html>
    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: lightgray;
            }
        </style>
    </head>
    <body>
        <div>
            @if($creation_type == 'Lot')
                <table>
                    <thead>
                        <tr>
                            <th>Lot Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$notification_data['lot_number']}}</td>
                        </tr>
                    </tbody>
                </table>                                                        
            @endif

            @if($creation_type == 'Wrc')
                <table>
                    <thead>
                        <tr>
                            <th>Wrc Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$notification_data['wrc_number']}}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </body>
</html>
