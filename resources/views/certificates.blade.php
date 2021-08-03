@extends('layout.myStructure')

@section('header')
    @parent

    <style>
        td{
            padding: 5px;
        }
    </style>

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">

@stop

@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('workshops')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>


    <div class="container-fluid">

        <div class="totalPane">

            <div class="row" style="margin-top: 100px">

                @if($registries == null || empty($registries))
                    <div class="col-xs-12">
                        <p style="color: black">کاربری در این رویداد شرکت نکرده است</p>
                    </div>
                @else
                    <div class="col-xs-12">
                        <table>
                            @foreach($registries as $registry)
                                <tr>
                                    <td><center>{{$registry->user}}</center></td>
                                    @if($registry->publish)
                                        <td><center>صادر شده</center></td>
                                        <td><center><button onclick="document.location.href = '{{route('publishCertificate', ['eventId' => $eventId, 'uId' => $registry->uId])}}'" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></center></td>
                                        <td><center><button onclick="removeCer('{{$registry->certificateId}}')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></center></td>
                                    @else
                                        <td><center>صادر نشده</center></td>
                                        <td><center><button onclick="document.location.href = '{{route('publishCertificate', ['eventId' => $eventId, 'uId' => $registry->uId])}}'" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button></center></td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        
        function removeCer(cerId) {

            $.ajax({
                type: 'post',
                url: '{{route('removeCertificate')}}',
                data: {
                    'certificateId': cerId
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('certificates', ['eventId' => $eventId])}}';
                }
            });

        }
        
    </script>
    
@stop