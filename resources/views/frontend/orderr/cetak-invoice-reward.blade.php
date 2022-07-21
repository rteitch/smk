<html>

<head>
    <title>Invoice Reward - {{ $orderr->reward_code }} - {{ $orderr->user->name }}</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()">

    <center>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:12pt'><b><img src="{{ asset('img/smkn2solo.png') }}" alt="smkn2solo-logo"
                            srcset="" width="50%"></b></span></br>
                Jl. Adi Sucipto No.33, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139 </br>
                Telp : +62 851 6140 3997
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>INVOICE REWARD</span></b></br>
                Tanggal : {{ $orderr->created_at }}</br>
            </td>
        </table>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                {{-- @dd($user) --}}
                Nama Siswa : {{ $orderr->user->name }}</br>
                NIS : {{ $orderr->user->nomor_induk }}
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                No Telp : {{$orderr->user->phone}}
            </td>
        </table>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;'
            border='1'>

            @foreach ($orderr->reward as $rewards)
                <tr align='center'>
                    <td width='10%'><b>Kode Reward</b></td>
                    <td width='20%'><b>Nama Reward</b></td>
                <tr align='center'>
                    <td>
                        {{ $orderr->reward_code }}</td>
                    <td>{{ $rewards->title }}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <table style='width:650; font-size:7pt;' cellspacing='2'>
            <tr>
                <td align='center'>Diterima Oleh,</br></br></br></br><u>(........................)</u></td>
                <td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td>
                <td align='center'>TTD,</br></br></br></br><u>(.......................)</u></td>
            </tr>
        </table>
    </center>
</body>

</html>
