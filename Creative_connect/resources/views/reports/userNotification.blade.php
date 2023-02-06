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
            {{-- creative lot create email template --}}
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

            {{-- creative Wrc create email template --}}
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

            {{-- creative Wrc allocation create email template --}}
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

             {{-- complete task in upload  email template (tasking) --}}
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

            {{--Qc Done and ready for submission email template --}}
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

            {{-- Catlog Lot  create email template --}}
            @if ($creation_type == 'CatlogLot')
                <table>
                    <thead>
                        <tr>
                            <th>Lot Number</th>
                            <th>Ready For Catlog Wrc Creation</th>
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
