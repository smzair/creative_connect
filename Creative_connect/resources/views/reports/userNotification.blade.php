<html>
    <head>
        <style>
            table {
                width: 80%;
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
                            <th>Ready For Wrc Creation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$notification_data['lot_number']}}</td>
                            <td>Yes</td>
                        </tr>
                    </tbody>
                </table>                                                        
            @endif

            @if($creation_type == 'Wrc')
                <table>
                    <thead>
                        <tr>
                            <th>Wrc Number</th>
                            <th>Ready For Allocation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$notification_data['wrc_number']}}</td>
                            <td>Yes</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            @if($creation_type == 'WrcAllocation')
                <table>
                    <thead>
                        <tr>
                            <th>Wrc Number</th>
                            <th>Allocated And Ready For Tasking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$notification_data->wrc_number}}</td>
                            <td>Yes</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            @if ($creation_type == 'completeTaskInUpload')
            <table>
                <thead>
                    <tr>
                        <th>Wrc Number</th>
                        <th>Tasking Done and ready for qc</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$notification_data->wrc_number}}</td>
                        <td>Yes</td>
                    </tr>
                </tbody>
            </table>
            @endif

            @if ($creation_type == 'Qc')
            <table>
                <thead>
                    <tr>
                        <th>Wrc Number</th>
                        <th>Qc Done and ready for submission</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$notification_data->wrc_number}}</td>
                        <td>Yes</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </body>
</html>
