@inject('bankQuery', 'App\Models\PaymentMethods\PaymentQuery')
@inject('customerQuery', 'App\Models\Customers\CustomerQuery')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>No.Invoice - {{$invoice->number }}</title>
    <link rel="stylesheet" href="{{asset('assets/css/pdf/pdf.css')}}" />

</head>
<body>

    <div>
       <table class="receipt-table" style="width:100%">
            <tr>
                <td align="left">
                    <table class="receipt-table" style="width: 70%">
                        <tbody>
                            <tr>
                               <td>
                                <img src="{{asset('images/bas_logo.png')}}" height="60" alt="" srcset="">
                               </td>
                            </tr>
                            <tr>
                                <td>Jl. Ahmad Yani Km 9 No 108 Kertak Hanyar Kab. Banjar 70249</td>
                            </tr>
                            <tr>
                                <td>KALIMANTAN SELATAN</td>
                            </tr>
                            <tr>
                                <td>
                                    Phone : 0511-4283605 / 0511-4283590
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email : finance@banualogistics.co.id
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background: #0000FF" ><font color="#fff" size="14px">BILL TO</font></td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($invoice->customer_id!=0)
                                       @php
                                           $customer =$customerQuery->getCustomerById($invoice->customer_id);
                                       @endphp
                                       {{$customer->name}}
                                    @else
                                        UMUM
                                    @endif
                                    </td>
                            </tr>
                            <tr>
                                <td>
                                    @if ($invoice->customer_id!=0)
                                     {{$customer->phone_customer}}<br>{{$customer->address}}
                                    @endif
                                </td>
                            </tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </td>
                <td align="right">
                    <br><br>
                    <table class="receipt-table" style="width: 100%">
                        <thead>
                            <tr>
                                <td align="center" colspan="2">
                                    <font color="#0000FF" size="28px">INVOICE</font>
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr style="background: #0000FF">
                                <td align="center"><font color="#fff" size="14px">INVOICE </font></td>
                                <td align="center"><font color="#fff" size="14px">DATE </font></td>
                            </tr>
                            <tr>
                                <td align="center">{{$invoice->number}}</td>
                                <td align="center">{{$invoice->date}}</td>
                            </tr>
                            <tr style="background: #0000FF">
                                <td align="center"><font color="#fff" size="14px"> CUSTOMER ID  </font></td>
                                <td align="center"><font color="#fff" size="14px">
                                    @if($invoice->payment_method_id==2)
                                    DUE DATE
                                    @else
                                    TERMS
                                    @endif
                                    </font>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    @if ($invoice->customer_id!=0)
                                        {{$customer->code.'-'.$customer->account_no}}
                                    @endif
                                </td>
                                <td align="center">
                                    @if($invoice->payment_method_id==2)
                                    {{$invoice->due_date}}
                                    @endif</td>
                            </tr>
                        </thead>


                    </table>
                </td>
            </tr>
       </table>
        <table class="receipt-table" style="width: 100%">
            <tbody>
                <tr>
                    <td align="center"><br>
                       @include('invoice.pdf.list-awb')
                    </td>
                </tr>
                <tr>
                    <td align="right"><br><br>

                    </td>
                </tr>

            </tbody>
        </table>
        <table class="recipt-table" style="width: 100%">
            <tbody>
                <tr>
                    <td  align="center">
                        <table class="recipt-table" style="width:70%">
                            <tbody>
                                <tr>
                                    <td colspan="2">Demikian ini kami sampaikan mohon untuk di koreksi kembali Apabila dalam waktu 7 (tujuh) hari sejak diterimanya perhitungan ini tidak ada koreksi, Maka Laporan ini kami anggap disetujui<br><br></td>
                                </tr>
                                <tr>
                                    <td colspan="2">PLEASE REMIT THE ABOVE AMOUNT TO FOLLOWING</td>
                                </tr>
                                @php
                                    $banks = $bankQuery->getBank();
                                @endphp
                                @foreach ($banks as $bank)
                                    <tr>
                                        <td style="width: 100px">ACCOUNT NO</td>
                                        <td>: {{$bank->bank_account_no}}</td>
                                    </tr>
                                    <tr>
                                        <td>BANK</td>
                                        <td>: {{$bank->bank_name}} {{" ".$bank->bank_account_name}}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </td>
                    <td  align="left"> HORMAT KAMI</td>
                </tr>

            </tbody>
        </table>
    </div>
</body>
