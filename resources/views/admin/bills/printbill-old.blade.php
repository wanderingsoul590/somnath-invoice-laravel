<!DOCTYPE html>
<html>

<head>
    <title>Somnath - Bill</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="custom.css"> -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body {
        background-color: #EFF8FF;
    }
    
    h1,
    p {
        margin: 0px;
    }
    
    .main-section {
        background-color: #FFF;
        border: 1px solid #025872;
    }
    
    .header {
        background-color: #025872;
        padding: 30px 15px 20px 15px;
        color: #fff;
    }
    
    .content {
        padding: 20px 15px 20px 15px;
    }
    
    th {
        background-color: #025872;
        color: #fff;
        text-align: right;
    }
    
    .table td:nth-child(1),
    .table th:nth-child(1) {
        text-align: left;
    }
    
    .lastSection {
        padding: 20px 15px 30px 15px;
    }
    
    hr {
        width: 250px;
        border: 1px solid #dddddd;
        margin: 30px 0 0 0;
    }
    
    table {
        width: 100%;
    }
    
    .ads.lastSection.col-md-12.col-sm-12.text-center {
        margin: 30px 0 0 0;
        background: #8d43ac;
        color: white;
        padding: 10px 0;
    }

@media print {
    .download, .print{
      display:none;
    }
}
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row main-section " id="myscreem">
                    <div class="col-md-12 col-sm-12 header" style="background-color: #025872 !important;">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h1 style="color:white !important;">HOTEL SOMNATH</h1>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <p> <strong style="color:white !important;">Invoice #{{ isset($data->id) ? $data->id : '' }}</strong></p>
                                <span><strong style="color:white !important;">{{ isset($data->date) ? date(config('const.displayDate'), strtotime($data->date)) : '' }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 content">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p>To.</p>
                                <p><b>Name: </b><span>{{ isset($data->customer->name) ? $data->customer->name : '' }}</span></p>
                                <p><b>Adress: </b><span>{{ isset($data->customer->address) ? $data->customer->address : '' }}</span></p>
                                <p><b>Company: </b><span>{{ isset($data->customer->company) ? $data->customer->company : '' }}</span></p>
                                <p><b>GST No: </b><span>{{ isset($data->customer->gst) ? $data->customer->gst : '' }}</span></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <p>From</p>
                                <p>Shiv Darshan Complex</p>
                                <p>Halvad Road Dhrangadhra-363310</p>
                                <p>Dist. Surendranagar</p>
                                <p>Cell: 8000066577</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-right">
                        <table class="table">
                            <td>
                                <table class="table text-right">
                                    <tbody>
                                        <tr>
                                            <td>Arrival Date</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ isset($data->checkin_date) ? date(config('const.displayDate'), strtotime($data->checkin_date)) : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Arrival Time</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ isset($data->checkin_time) ? date(config('const.displayTime'), strtotime($data->checkin_time)) : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Room No.</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ isset($data->room_number) ? $data->room_number : '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Departure Date</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ isset($data->checkout_date) ? date(config('const.displayDate'), strtotime($data->checkout_date)) : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Departure Time</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ isset($data->checkout_time) ? date(config('const.displayTime'), strtotime($data->checkout_time)) : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Persion</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ isset($data->person) ? $data->person : '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </table>
                    </div>
                    <div class="col-md-12 col-sm-12 text-right">
                        <table class="table">
                            <thead>
                                <tr style="background-color: #025872 !important;">
                                    <th style="background-color: #025872 !important;color:white !important">Description</th>
                                    <th style="background-color: #025872 !important;color:white !important"></th>
                                    <th style="background-color: #025872 !important;color:white !important"></th>
                                    <th style="background-color: #025872 !important;color:white !important">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Charge Per Day</td>
                                    <td></td>
                                    <td></td>
                                    <td>₹ {{ isset($data->room_charge) ? $data->room_charge : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Total Days</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ isset($data->total_days) ? $data->total_days : '' }}</td>
                                </tr>
                                <!-- <tr>
                                    <td>Room Category</td>
                                    <td></td>
                                    <td></td>
                                    <td>$100</td>
                                </tr> -->
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Subtotal</td>
                                    <td>₹ {{ isset($data->subtotal) ? number_format($data->subtotal, 2) : 0 }}</td>
                                </tr>
                                @if(isset($data->gst_type) && $data->gst_type == config('const.gstTypeCgstSgst'))
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong> CGST 6%</strong></td>
                                    <td>₹ {{ isset($data->cgst) ? number_format($data->cgst, 2) : 0 }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>SGST 6%</strong></td>
                                    <td>₹ {{ isset($data->sgst) ? number_format($data->sgst, 2) : 0 }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>IGST 12%</strong></td>
                                    <td>-</td>
                                </tr>
                                @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td> <strong> CGST 6%</strong></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>SGST 6%</strong></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>IGST 12%</strong></td>
                                    <td>₹ {{ isset($data->igst) ? number_format($data->igst, 2) : 0 }}</td>
                                </tr>
                                @endif                                
                                <tr style="background-color: #025872 !important;">
                                    <th style="background-color: #025872 !important;color:white !important"></th>
                                    <th style="background-color: #025872 !important;color:white !important"></th>
                                    <th colspan="1" style="text-align: right; background-color: #025872 !important;color:white !important">Net Amount:</td>
                                        <th style="background-color: #025872 !important;color:white !important">₹ {{ isset($data->netamount) ? number_format($data->netamount, 2) : 0 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12  ">
                        <table>
                            <td style="display: flex;flex-direction: column;">
                                <strong>Note:</strong>
                                <p>Check Our time at 10:00 am</p>
                                <p>Subject to Dhrangadhra Jurisdiction. E & O.E.</p>
                            </td>
                            <td class="text-right">
                                <strong>Bank Details:</strong>
                                <p>Bank Name: HDFC Bank</p>
                                <p>A/c No: 50200034894129</p>
                                <p>IFSC CODE: HDFC0001710</p>
                                <p>SAC Code: 996311</p>
                            </td>
                        </table>
                    </div>


                    <div class="col-md-12 col-sm-12 text-left ">
                        <table>
                            <td>
                                <hr>
                                <p>Authorised Signature</p>
                            </td>
                            <td>
                                <hr>
                                <p>Customer's Signature</p>
                            </td>
                        </table>
                    </div>

                    <div class="ads lastSection col-md-12 col-sm-12 text-center" style="background-color: #025872 !important;color:white !important">
                        <spam style="color:white !important;">WE WISH YOU A HAPPY JOURNEY, THANKS FOR COMING AND UPCOMING VISITS</spam><br>
                        <spam style="color:white !important;">Hotel Somnath is available for you with....</spam><br>
                        <spam style="color:white !important;">AC/Non AC Royal and Deluxe Rooms have LCD,Intercom and Nice Spacious Interior Conference Hall, Reception Hall, Restful waiting Room</spam>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="master.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="script.js"></script>
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/app-invoice-print.js') }}"></script>
</body>

</html>